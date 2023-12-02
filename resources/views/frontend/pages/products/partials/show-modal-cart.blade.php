<!-- Modal -->
<form action="{{ route('frontend.carts.addToCart', ['userId' => auth()->user()->id]) }}" method="POST">
    @csrf
    @method('POST')
    <div class="modal fade" id="modalCart-{{ $product->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">@lang('Optional')</h5>
                    <button type="button" class="close close-add-to-cart" data-dismiss="modal" aria-label="Close">
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
                            @forelse($productDetails as $key => $productDetail)
                                <tr>
                                    <td class="text-center align-middle">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td class="text-center align-middle">
                                        <input type="hidden" name="productDetail[{{ $key }}][color]"
                                            value="{{ $productDetail->color }}">
                                        {{ $productDetail->color }}
                                    </td>
                                    <td class="text-center align-middle">
                                        <input type="hidden" name="productDetail[{{ $key }}][size]"
                                            value="{{ $productDetail->size }}">
                                        {{ $productDetail->size }}
                                    </td>
                                    <td class="text-center align-middle">
                                        {{ $productDetail->quantity }}
                                    </td>
                                    <td class="text-center align-middle">
                                        <input type="hidden" name="productDetail[{{ $key }}][price]"
                                            value="{{ $productDetail->price }}">
                                        {{ $productDetail->price }}$
                                    </td>
                                    <td class="text-center align-middle">
                                        <div class="quantity">
                                            <div class="pro-qty">
                                                <input type="hidden"
                                                    name="productDetail[{{ $key }}][productDetailId]"
                                                    value="{{ $productDetail->id }}">
                                                <input type="hidden" name="productId" value="{{ $product->id }}">
                                                <span class="dec qtybtn dec-{{ $productDetail->id }}"
                                                    data-product-id="{{ $productDetail->id }}"
                                                    data-max-quantity="{{ $productDetail->quantity }}">-</span>
                                                <input
                                                    class="quantityInput-{{ $productDetail->id }} input-quantity-in-product-detail"
                                                    type="number" value="0"
                                                    name="productDetail[{{ $key }}][quantity]"
                                                    defaultValue="0" min="0"
                                                    data-product-id="{{ $productDetail->id }}"
                                                    data-max-quantity="{{ $productDetail->quantity }}">
                                                <span class="inc qtybtn inc-{{ $productDetail->id }}"
                                                    data-product-id="{{ $productDetail->id }}"
                                                    data-max-quantity="{{ $productDetail->quantity }}">+</span>
                                            </div>
                                        </div>
                                        @include('frontend.pages.products.partials.show-modal-max-quantity', [
                                            'productDetailId' => $productDetail->id,
                                            'maxQuantity' => $productDetail->quantity,
                                        ])
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
                    <button type="button" class="btn btn-secondary close-add-to-cart" data-dismiss="modal">@lang('Close')</button>
                    <button type="submit" class="btn btn-primary">@lang('Add to cart')</button>
                </div>
            </div>
        </div>
    </div>
</form>