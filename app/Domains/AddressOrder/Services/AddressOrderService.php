<?php

namespace App\Domains\AddressOrder\Services;

use App\Domains\AddressOrder\Models\AddressOrder;
use App\Services\BaseService;

/**
 * Class AddressOrderService.
 */
class AddressOrderService extends BaseService
{
    /**
     * AddressOrder constructor.
     */
    public function __construct(
        AddressOrder $addressOrder
    ) {
        $this->model = $addressOrder;
    }
}
