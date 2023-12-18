<input type="hidden" name="ship" value="{{ $ship }}">
<input type="hidden" name="totalAllProduct" value="{{ $totalAllProduct }}">
<div class="checkout__order__total" id="ship-price" data-ship-price="{{ $ship }}">Ship <span
        style="color:black">{{ formatMoney($ship) }}</span></div>
<div class="checkout__order__total">Total <span>{{ formatMoney($totalAllProduct) }}</span></div>
