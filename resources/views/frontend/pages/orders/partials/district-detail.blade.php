<select class="form-control w-100 filter-select" id="select-district" data-total-cost="{{ $totalAllProduct }}" name="district">
    <option value="default">@lang('Choose District')</option>
    @if (!empty($districts))
        @foreach ($districts as $district)
            <option class="district-option-{{ $district['DistrictID'] }}" value="{{ $district['DistrictID'] }}"
                {{ $oldDistrict == $district['DistrictID'] ? 'selected' : '' }}
                data-url="{{ route('frontend.orders.getWardDetail', ['districtID' => $district['DistrictID']]) }}"
                data-district-id="{{ $district['DistrictID'] }}" data-total-cost="{{ $totalAllProduct }}">
                {{ $district['DistrictName'] }}</option>
        @endforeach
    @endif
</select>

<script src="{{ asset('js/pages/filter.js') }}"></script>
<script src="{{ asset('js/pages/checkout/address.js') }}"></script>
