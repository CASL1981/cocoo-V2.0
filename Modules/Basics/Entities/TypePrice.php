<?php

namespace Modules\Basics\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class TypePrice extends Model
{
    use HasFactory;
    use Userstamps;
    use SoftDeletes;

    protected $fillable = ['name', 'increment', 'tax', 'status', 'type', 'minimum', 'maximum'];

    protected $table = 'basic_type_prices';

    protected static function newFactory()
    {
        return \Modules\Basics\Database\factories\TypePriceFactory::new();
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
        ->select('id','name', 'increment', 'tax', 'status', 'type','minimum', 'maximum')
        ->search('name', $keyWord)
        ->search('status', $keyWord)
        ->orderBy($sortField, $sortDirection);
    }
}
