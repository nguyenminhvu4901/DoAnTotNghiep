@extends('frontend.layouts.app')

@section('title', __('Product chart'))

@section('content')
    <div class="mt-4 p-3 container">
        <div class="p-3 pl-2 font-weight-bold">
            <h3><strong>@lang('Sale statistic')</strong></h3>
        </div><!--row-->
    </div><!--container-->
    <div class="p-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-6">
                    <p>
                        <strong>@lang('Top :number sellings', ['number' => config('constants.top_best_seller_amount')])</strong>
                    </p>
                    <canvas id="best-seller-chart" class="border cursor-pointer"></canvas>
                </div>
                <div class="col-6">
                    <div id="display-product-detail">

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('after-scripts')
    <div id="js-data" class="d-none" data-best-seller-chart-data="{{json_encode($bestSellerBarChartData)}}"
         data-detail-url="{{ route('frontend.productChart.show') }}"
    ></div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0">
    </script>

    Chart.register(ChartDataLabels);

    <script type="text/javascript">
      (function (_) {
        _(window.jQuery, window, document)
      }(async function ($, window, document) {
        const data = $('#js-data').data('best-seller-chart-data');
        const ids = data.map(product => product.id);
        const barChart = new Chart(
          document.getElementById('best-seller-chart'),
          {
            type: 'bar',
            options: {
              animation: true,
              responsive: true,
              scales: {
                x: {
                  ticks: {
                    stepSize: 1,
                    beginAtZero: true,
                  },
                  title: {
                    display: true,
                    text: 'sales'
                  }
                }
              },
              plugins: {
                legend: {
                  display: false
                },
                tooltip: {
                  enabled: true
                }
              },
              indexAxis: 'y',
            },
            data: {
              labels: data.map(row => row.name),
              datasets: [
                {
                  label: 'sale',
                  data: data.map(row => row.sales),
                }
              ]
            }
          }
        );

        async function getPieChart(productId) {
          try {
            const response = await actions.ajaxCall({
              url: $('#js-data').data('detail-url'),
              method: 'GET',
              data: {'id': productId}
            });
            $('#display-product-detail').html(response.html);
            $('.selection').first().trigger('change');
          } catch (e) {
            alert('There were a problem fetching data on server, please try again later')
          }
        }

        $('#best-seller-chart').on('click', async function (e) {
          const canvas = $(this)[0];
          const click = e;
          const top = barChart.scales.y.top;
          const bottom = barChart.scales.y.bottom;
          const left = barChart.scales.y.left;
          const right = barChart.scales.y.right;
          const height = (bottom - top) / barChart.scales.y.ticks.length;
          let resetCoordinates = canvas.getBoundingClientRect();
          const x = click.clientX - resetCoordinates.left;
          const y = click.clientY - resetCoordinates.top;
          if (x >= left && x <= right && y >= top && y <= bottom) {
            let topBound = top;
            let bottomBound = top + height;
            for (let i = 0; i < barChart.scales.y.ticks.length; ++i) {
              if (y >= topBound && y <= bottomBound) {
                await getPieChart(ids[i]);
                break;
              }
              topBound = bottomBound;
              bottomBound = bottomBound + height;
            }
          }
        })

        let pieChart = undefined;

        $(document).on('shown.bs.tab', function (e) {
          $($(e.target).data('target')).find('.selection').first().trigger('change');
        })

        $(document).off('change', '.selection').on('change', '.selection', function () {
          if (pieChart !== undefined) {
            pieChart.destroy();
          }
          const selection = $(this).data('selection');
          let orderData, labels;
          if (selection === 'size') {
            orderData = $('#chart-js-data').data('product-orders').filter((order) => order.product_size === $(this).val());
            labels = orderData.map(order => 'color:' + order.product_color);
          } else {
            orderData = $('#chart-js-data').data('product-orders').filter((order) => order.product_color === $(this).val());
            labels = orderData.map(order => 'size:' + order.product_size);
          }

          $('.no-sale').remove();

          if (labels.length === 0) {
            $('#pie-chart').after(
              `<div class="no-sale p-1">No sale found 😞</div>`
            )
            $('#pie-chart').addClass('d-none');
          } else {
            $('#pie-chart').removeClass('d-none');
          }


          const datasets = [{
            label: 'sale',
            data: orderData.map(order => order.product_quantity),
            hoverOffset: 4
          }]
          const config = {
            type: 'pie',
            data: {
              labels,
              datasets,
            },
            plugins: [ChartDataLabels],
            options: {
              plugins: {
                datalabels: {
                  backgroundColor: function(context) {
                    return context.dataset.backgroundColor;
                  },
                  color: 'white',
                  display: function(context) {
                    var dataset = context.dataset;
                    var count = dataset.data.length;
                    var value = dataset.data[context.dataIndex];
                    return value > count * 1.5;
                  },
                  font: {
                    weight: 'bold',
                    size: '15px'
                  },
                  padding: 6,
                  formatter: Math.round
                }
              },
            },
          };
          pieChart = new Chart(
            document.getElementById('pie-chart'),
            config
          );

        })

        if (ids.length > 0) {
          await getPieChart(ids[0]);
        }

      }));
    </script>
@endpush