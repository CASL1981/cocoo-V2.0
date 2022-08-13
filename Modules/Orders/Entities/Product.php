<?php

namespace Modules\Orders\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Basics\Entities\Classification;
use Modules\Basics\Entities\Client;
use Wildside\Userstamps\Userstamps;

class Product extends Model
{
    use HasFactory;
    use Userstamps;
    use SoftDeletes;

    protected $fillable = ['name', 'tax', 'status', 'basic_client_id', 'tax_percentage', 'brand', 
                        'measure_unit', 'basic_classification_id', 'image'];

    protected $table = 'order_products';
    
    protected static function newFactory()
    {
        return \Modules\Orders\Database\factories\ProductFactory::new();
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
        ->with(['clients', 'classifications'])
        ->select('id','name', 'tax', 'status', 'basic_client_id','tax_percentage',
                             'brand', 'measure_unit', 'basic_classification_id', 'image')
        ->orWhereHas('clients', function($query) use ($keyWord){
            $query->where('client_name','like','%'.$keyWord.'%');
        })
        ->orWhereHas('classifications', function($query) use ($keyWord){
            $query->where('name','like','%'.$keyWord.'%');
        })
        ->search('name', $keyWord)
        ->search('brand', $keyWord)
        ->search('measure_unit', $keyWord)
        ->orderBy($sortField, $sortDirection); 
    }

    public function clients()
    {
        return $this->belongsTo(Client::class, 'basic_client_id', 'id');
    }

    public function classifications()
    {
        return $this->belongsTo(Classification::class, 'basic_classification_id', 'id');
    }
}
