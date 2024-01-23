{{-- NAME --}}
<input type="hidden" class="sub-js" data-sub="{{ json_encode([
        'preview_image' => __('New Image'),
    ]) }}">
<div class="form-group row">
    <label for="input_name" class="col-sm-2 col-form-label">
        @lang('Product name')
    </label>
    <div class="col-sm-5">
        <input type="text" disabled class="form-control rounded" value="{{ isset($product) ? $product->name : '' }}">
    </div>
</div>

<div class="form-group row">
    <label for="input_name" class="col-sm-2 col-form-label">
        @lang('Product Image name') <span class="text-danger">*</span>
    </label>
    <div class="col-sm-5">
        <input type="text" class="form-control rounded {{ checkDisplayError($errors, 'name') }}" id="input_name"
            name="name" placeholder="@lang('Name')"
            value="{{ old('name') ?? (isset($productImage) ? $productImage->name : '') }}">
        <small id="error_name" class="error text-danger">{{ $errors->first('name') }}</small>
    </div>
</div>

<div class="form-group row">
    <label for="input_name" class="col-sm-2 col-form-label">
        @lang('Order') <span class="text-danger">*</span>
    </label>
    <div class="col-sm-5">
        <input type="text" class="form-control rounded {{ checkDisplayError($errors, 'order') }}" id="input_order"
            name="order" placeholder="@lang('Order')"
            value="{{ old('order') ?? (isset($productImage) ? $productImage->order : '') }}">
        <small id="error_order" class="error text-danger">{{ $errors->first('order') }}</small>
    </div>
</div>

<div class="form-group row">
    <label for="image_path" class="col-sm-2 col-form-label">
        @lang('Old Image')
    </label>
    <div class="col-sm-5">
        <input type="hidden" name="old_image" value="{{ $productImage->image_path }}">
        <img src="{{ $productImage->getImageUrlAttribute() }}" alt="">
    </div>
</div>

<div class="form-group row">
    <label for="image_path" class="col-sm-2 col-form-label">
        @lang('Product Image') <span class="text-danger">*</span>
    </label>
    <div class="col-sm-5">
        <input type="file" class="form-control rounded {{ checkDisplayError($errors, 'image_path') }}"
            id="input_image_product" name="image_path" placeholder="@lang('Image')"
            value="{{ old('image_path') ?? (isset($productImage) ? $productImage->image_path : '') }}">
        <small id="error_image_path" class="error text-danger">{{ $errors->first('image_path') }}</small>
    </div>
</div>
@include('frontend.pages.partials.form.order-rule')

<div id="image-preview"></div>

@push('after-scripts')
    <script src="{{ asset('js/pages/formRules.js') }}"></script>
    <script src="{{ asset('js/pages/product-image/image.js') }}"></script>
@endpush
