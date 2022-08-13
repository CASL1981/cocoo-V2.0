<?php

namespace Modules\Orders\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Basics\Entities\Client;
use Modules\Basics\Entities\TypePrice;
use Wildside\Userstamps\Userstamps;

class Price extends Model
{    
    
    use HasFactory;
    use Userstamps;
    use SoftDeletes;
    
    protected $fillable = ['order_product_id', 'order_product_name', 'basic_client_id', 'basic_type_price_id', 'date', 'value', 'status'];
    
    protected $table = 'order_prices';
    
    protected static function newFactory()
    {
        return \Modules\Orders\Database\factories\PriceFactory::new();
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

    public function QueryTable($keyWord = null, $sortField, $sortDirection)
    {
        return $this->withTrashed()
        ->with(['clients', 'products', 'typeprices'])
        ->select('id','order_product_id', 'order_product_name', 'basic_client_id', 'basic_type_price_id', 'date', 'value', 'status')
        ->orWhereHas('clients', function($query) use ($keyWord){
            $query->where('client_name','like','%'.$keyWord.'%');
        })
        ->orWhereHas('products', function($query) use ($keyWord){
            $query->where('name','like','%'.$keyWord.'%');
        })
        ->orWhereHas('typeprices', function($query) use ($keyWord){
            $query->where('name','like','%'.$keyWord.'%');
        })
        ->orderBy($sortField, $sortDirection); 
    }

    public function clients(): BelongsTo
    {
        return $this->belongsTo(Client::class, 'basic_client_id', 'id');
    }

    public function products(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'order_product_id', 'id');
    }

    public function typeprices(): BelongsTo
    {
        return $this->belongsTo(TypePrice::class, 'basic_type_price_id', 'id');
    }
}
