<?php

namespace App\Domains\Order\Models\Traits\Attribute;

trait OrderAttribute
{
    public function getFormattedPaymentAttribute()
    {
        if ($this->attributes['payment_method'] == config('constants.payment_method.direct')) {
            return __('Payment on delivery');
        } else if ($this->attributes['payment_method'] == config('constants.payment_method.vnpay')) {
            return __('Payment via VNPay wallet');
        } else if ($this->attributes['payment_method'] == config('constants.payment_method.momo')) {
            return __('Payment via Momo wallet');
        } else {
            return $this->attributes['payment_method'];
        }
    }

    public function getFormattedOrderStatusAttribute()
    {
        if ($this->attributes['status'] == config('constants.status_order.cancel')) {
            return __('Order canceled');
        } else if ($this->attributes['status'] == config('constants.status_order.ready_to_pick')) {
            return __('Preparing orders');
        } else if ($this->attributes['status'] == config('constants.status_order.picking')) {
            return __('Sending order');
        } else if ($this->attributes['status'] == config('constants.status_order.send_to_carrier')) {
            return __('The carrier has received the goods');
        } else if ($this->attributes['status'] == config('constants.status_order.delivering')) {
            return __('Order is being delivered');
        } else if ($this->attributes['status'] == config('constants.status_order.delivering')) {
            return __('Order delivered successfully');
        } else {
            return $this->attributes['status'];
        }
    }

        /**
     * @return ?string
     */
    public function getCreatedByAttribute(): ?string
    {
        return optional($this->owner)->name;
    }
}
