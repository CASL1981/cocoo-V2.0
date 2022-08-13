<?php

namespace Modules\Orders\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Wildside\Userstamps\Userstamps;

class DetailOperation extends Model
{
    use HasFactory;
    use Userstamps;

    public $subTotalItem;

    protected $fillable = ['order_product_id', 'product_name', 'quantity', 'price', 'tax_sale', 'price', 'tax_sale_percentage', 'discount', 
    'discount_percentage','subtotal', 'total', 'measure_unitd', 'received', 'status', 'order_operation_id', 'basic_destination_id',
    'created_by', 'updated_by', 'deleted_by'];

    protected $table = 'order_detail_operations';
    
    protected static function newFactory()
    {
        return \Modules\Orders\Database\factories\DetailOperationsFactory::new();
    }

    public function getStatusColorAttribute()
    {
        return [
            'Open' => 'success',
            'Blocked' => 'warning',
            'Cancelled' => 'danger',
        ][$this->status] ?? 'info';
    }

    protected $casts = [
        'created_at' => 'datetime:Y-m-d h:m:s',
        'updated_at' => 'datetime:d-m-Y h:m:s',
        'deleted_at' => 'datetime:d-m-Y h:m:s',
    ];

    public function getSubTotalItem(int $quantity)
    {
        $this->subTotalItem = (floatval($this->price - $this->discount)) * $quantity;

        return $this->subTotalItem;
    }

    public function getTotalItem()
    {         
        return $this->subTotalItem + $this->tax_sale;
    }

    public function getTaxSaleItem()
    {
        return floatval($this->subTotalItem * $this->tax_sale_percentage/100);
    }
}
