<?php

namespace Modules\Orders\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Basics\Entities\Classification;
use Modules\Basics\Entities\Client;
use Modules\Basics\Entities\Payment;
use Wildside\Userstamps\Userstamps;

class Operation extends Model
{
    use HasFactory;
    use Userstamps;
    use SoftDeletes;

    protected $fillable = ['date', 'status', 'basic_client_id', 'basic_payment_id', 'observation', 'order_type_price_id', 
                        'biller', 'responsible', 'basic_classification_id', 'brute', 'discount', 'subtotal', 'tax_sale', 'total',
                        'created_by', 'updated_by', 'deleted_by'];

    protected $table = 'order_operations';
    
    protected static function newFactory()
    {
        return \Modules\Orders\Database\factories\OperationFactory::new();
    }    

    public function getStatusColorAttribute()
    {
        return [
            'Activo' => 'success',
            'Inactivo' => 'warning',
            'Eliminado' => 'danger',
        ][$this->status] ?? 'info';
    }

    protected $casts = [
        'created_at' => 'datetime:Y-m-d h:m:s',
        'updated_at' => 'datetime:d-m-Y h:m:s',
        'deleted_at' => 'datetime:d-m-Y h:m:s',
    ];

    public function QueryTable($keyWord = null, $sortField, $sortDirection)
    {
        return $this->withTrashed()
        ->with(['clients', 'classifications', 'payments', 'typeprices'])
        ->select('id','date', 'status', 'basic_client_id','basic_payment_id', 'observation',
                             'order_type_price_id', 'biller', 'responsible', 'basic_classification_id',
                             'brute', 'discount', 'subtotal', 'tax_sale', 'total')
        ->orWhereHas('clients', function($query) use ($keyWord){
            $query->where('client_name','like','%'.$keyWord.'%');
        })
        ->orWhereHas('classifications', function($query) use ($keyWord){
            $query->where('name','like','%'.$keyWord.'%');
        })
        ->search('status', $keyWord)
        ->search('observation', $keyWord)        
        ->orderBy($sortField, $sortDirection); 
    }

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
        return $this->belongsTo(TypePrice::class, 'order_type_price_id', 'id');
    }
}
