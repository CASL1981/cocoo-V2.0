<?php

namespace App\Services\OrderNumber;

use App\Models\Setting;

class OrderNumberService
{
    private $setting;
    private $lockedSetting;

    public function __construct(OrderNumberConfig $config)
    {
        if ($config->isDisabled()) {
            return null;
        }
        $this->setting = Setting::query();
        $this->lockedSetting = $this->setting->lockForUpdate()->first();
    }

    public function setNextOrderNumber()
    {
        $currentNumber = $this->nextOrderNumber();
        $this->increaseOrderNumber();

        return $currentNumber;
    }

    public function setOrderNumber(Int $OrderNumber)
    {
        $this->lockedSetting->Order_number = $OrderNumber;
        return $this->lockedSetting->save();
    }

    public function nextOrderNumber()
    {
        return $this->setting->first()->Order_number;
    }

    private function increaseOrderNumber()
    {
        $this->lockedSetting->Order_number++;
        return $this->lockedSetting->save();
    }
}
