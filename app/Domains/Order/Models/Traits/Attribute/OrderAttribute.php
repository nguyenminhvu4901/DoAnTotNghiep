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
        } else if ($this->attributes['status'] == config('constants.status_order.delivered') &&
            ($this->attributes['status_return_order'] == config('constants.status_return_order.Cancel return order'))) {
            return __('Order is being delivered and cannot return order');
        } else if (config('constants.status_return_order.Successful delivery') == $this->attributes['status_return_order'] &&
            $this->attributes['is_return_order'] == 1) {
            return __('Wait for the shop to confirm.');
        } else if (config('constants.status_return_order.Successful delivery') == $this->attributes['status_return_order'] &&
            $this->attributes['is_return_order'] == 2) {
            return __('Order is being delivered and cannot return order');
        } else if ($this->attributes['status'] == config('constants.status_order.delivered') &&
            ($this->attributes['status_return_order'] != config('constants.status_return_order.Successful delivery') &&
            $this->attributes['status_return_order'] != config('constants.status_return_order.Refund successful'))) {
            return __('Return Order');
        } else if ($this->attributes['status_return_order'] == config('constants.status_return_order.Refund successful')) {
            return __('Refund successful');
        } else if ($this->attributes['status'] == config('constants.status_order.delivered')) {
            return __('Order delivered successfully');
        } else {
            return $this->attributes['status'];
        }
    }

    public function getFormattedReturnOrderStatusAttribute()
    {
        if ($this->attributes['status_return_order'] == config('constants.status_return_order.Cancel return order')) {
            return __('Cancel return order');
        } else if ($this->attributes['status_return_order'] == config('constants.status_return_order.Successful delivery')) {
            return __('Successful delivery');
        } else if ($this->attributes['status_return_order'] == config('constants.status_return_order.Preparing orders')) {
            return __('Preparing orders');
        } else if ($this->attributes['status_return_order'] == config('constants.status_return_order.Shipped')) {
            return __('Shipped');
        } else if ($this->attributes['status_return_order'] == config('constants.status_return_order.Shop has received the goods')) {
            return __('Shop has received the goods');
        } else if ($this->attributes['status_return_order'] == config('constants.status_return_order.Refund successful')) {
            return __('Refund successful');
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
