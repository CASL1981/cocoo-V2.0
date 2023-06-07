<?php

namespace Modules\Orders\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Basics\Entities\Classification;
use Modules\Basics\Entities\Client;
use Modules\Basics\Entities\Payment;
use Modules\Basics\Entities\TypePrice;
use Wildside\Userstamps\Userstamps;

class Operation extends Model
{
    use HasFactory;
    use Userstamps;
    use SoftDeletes;

    protected $fillable = ['date', 'status', 'basic_client_id', 'basic_payment_id', 'basic_payment_interval', 'observation', 'basic_type_price_id',
                        'biller', 'responsible', 'delivery_time', 'basic_classification_id', 'brute', 'discount', 'subtotal', 'tax_sale', 'total',
                        'basic_client_name', 'basic_payment_name', 'basic_classification_name', 'basic_type_price_name', 'created_by', 'updated_by',
                        'deleted_by', 'recibido', 'month', 'year', 'document','number',];

    protected $table = 'order_operations';

    protected $casts = [
        'created_at' => 'datetime:Y-m-d h:m:s',
        'updated_at' => 'datetime:d-m-Y h:m:s',
        'deleted_at' => 'datetime:d-m-Y h:m:s',
    ];

    protected static function newFactory()
    {
        return \Modules\Orders\Database\factories\OperationFactory::new();
    }

    public function getStatusColorAttribute()
    {
        return [
            'Open' => 'success',
            'Blocked' => 'warning',
            'Cancelled' => 'danger',
        ][$this->status] ?? 'info';
    }

    public function QueryTable($keyWord = null, $sortField, $sortDirection)
    {
        return $this->withTrashed()
        ->with(['clients'])
        ->select('id','document','number','date', 'status', 'basic_client_id','basic_payment_id','basic_payment_interval', 'observation', 'delivery_time',
                'basic_type_price_id', 'biller', 'responsible', 'basic_classification_id',
                'basic_client_name', 'basic_payment_name', 'basic_classification_name', 'recibido',
                'basic_type_price_name', 'brute', 'discount', 'subtotal', 'tax_sale', 'total')
        ->search('status', $keyWord)
        ->search('observation', $keyWord)
        ->search('basic_client_name', $keyWord)
        ->search('basic_payment_name', $keyWord)
        ->search('basic_classification_name', $keyWord)
        ->orderBy($sortField, $sortDirection);
    }

    //Mutator
    /**
     * Set the operatrion's Month.
     *
     * @return void
     */
    public function setMonthAttribute($value)
    {
        $this->attributes['month'] = $value;
    }

    //Relations

    public function clients(): BelongsTo
    {
        return $this->belongsTo(Client::class, 'basic_client_id', 'id');
    }

    public function classifications(): BelongsTo
    {
        return $this->belongsTo(Classification::class, 'basic_classification_id', 'id');
    }

    public function payments(): BelongsTo
    {
        return $this->belongsTo(Payment::class, 'basic_payment_id', 'id');
    }
    public function typeprices(): BelongsTo
    {
        return $this->belongsTo(TypePrice::class, 'basic_type_price_id', 'id');
    }
}
