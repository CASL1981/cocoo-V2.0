<?php

namespace App\Services\OrderNumber;

use Modules\Orders\Entities\Operation;

class OrderNumberValidator
{
    public function validateOrderNumberSize(Int $OrderNumber)
    {
        if ($OrderNumber <= 9999999 && $OrderNumber >= 1) {
            return true;
        }

        return false;
    }

    public function validateOrderNumberIsNotLowerThenCurrentMax(Int $OrderNumber)
    {
        $currentOrderNumber = optional(Operation::query()->orderByDesc('Order_number')->limit(1)->first())->Order_number;
        if ($OrderNumber > $currentOrderNumber) {
            return true;
        }

        return false;
    }

    public function validateOrderNumber(Int $OrderNumber)
    {
        if ($this->validateOrderNumberIsNotLowerThenCurrentMax($OrderNumber) && $this->validateOrderNumberSize($OrderNumber)) {
            return true;
        }

        return false;
    }
}
