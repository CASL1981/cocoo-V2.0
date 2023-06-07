<?php

namespace Modules\Orders\Services;

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
        $currentOrderNumber = optional(Operation::query()->orderByDesc('number')->limit(1)->first())->number;
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
