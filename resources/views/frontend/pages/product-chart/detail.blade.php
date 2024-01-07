<h4>
    {{ $product->name }}
</h4>
<div>
    <p>
        <span> {{ __('Sale figure') .':' }} </span>
        <span> {{ $product->getSaleCount() . '!!'}}</span>
    </p>
    <ul class="nav nav-tabs" id="tab-selection" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" data-toggle="tab" data-target="#group-by-size" type="button" role="tab" aria-controls="group-by-size" aria-selected="true">{{__('Group by size')}}</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" data-toggle="tab" data-target="#group-by-color" type="button" role="tab" aria-controls="group-by-color" aria-selected="false">{{ __('Group by color') }}</button>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane fade show active" id="group-by-size" role="tabpanel" aria-labelledby="group-by-size">
            <select class="form-control cursor-pointer selection" id="size-selection" data-selection="size">
                @foreach($product->productDetail->unique('size') as $detail)
                    <option class="cursor-pointer" value="{{ $detail->size }}">{{ $detail->size }}</option>
                @endforeach
            </select>
        </div>
        <div class="tab-pane fade" id="group-by-color" role="tabpanel" aria-labelledby="group-by-color">
            <select class="form-control cursor-pointer selection" id="color-selection" data-selection="color">
                @foreach($product->productDetail->unique('color') as $detail)
                    <option class="cursor-pointer" value="{{ $detail->color }}">{{ $detail->color }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div>
        <canvas id="pie-chart"></canvas>
    </div>
    <div id="chart-js-data" class="d-none" data-product-orders="{{ json_encode($product->orders) }}">
    </div>
</div>