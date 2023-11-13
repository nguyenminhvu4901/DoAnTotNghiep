<!-- Modal -->
<div class="modal fade" id="modalCart-{{ $product->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">@lang('Optional')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table-info table">
                    <thead>
                        <tr>
                            <th class="text-center">@lang('No.')</th>
                            <th scope="col" class="text-center">@lang('Color')</th>
                            <th scope="col" class="text-center">@lang('Size')</th>
                            <th scope="col" class="text-center">@lang('Quantity in stock')</th>
                            <th scope="col" class="text-center">@lang('Price')</th>
                            <th scope="col" class="text-center">@lang('Quantity')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($productDetails as $productDetail)
                            <tr>
                                <td class="text-center align-middle">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="text-center align-middle">
                                    {{ $productDetail->color }}
                                </td>
                                <td class="text-center align-middle">
                                    {{ $productDetail->size }}
                                </td>
                                <td class="text-center align-middle">
                                    {{ $productDetail->quantity }}
                                </td>
                                <td class="text-center align-middle">
                                    {{ $productDetail->price }}$
                                </td>
                                <td class="text-center align-middle">
                                    <div class="product__details__quantity">
                                        <div class="quantity">
                                            <div class="pro-qty">
                                                <input class="quantityInput" type="text" value="0"
                                                    data-max-quantity="{{ $productDetail->quantity }}" defaultValue="0">
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">@lang('Not found data')</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('Close')</button>
                <button type="submit" class="btn btn-primary">@lang('Add to cart')</button>
            </div>
        </div>
    </div>
</div>
