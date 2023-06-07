<?php

namespace Modules\Orders\Services;

use Modules\Basics\Entities\Sequence;

class OrderNumberService
{
    private $setting;
    private $lockedSetting;

    private $document;

    public function __construct()
    {
        // if ($config->isDisabled()) {
        //     return null;
        // }
        // $this->document = $document;
        $this->setting = Sequence::query();
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
        return $this->setting->where('document', 'OC')->first()->number;
    }

    private function increaseOrderNumber()
    {
        $this->lockedSetting->number++;
        return $this->lockedSetting->save();
    }
}
