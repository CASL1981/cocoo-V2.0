<?php

namespace Modules\Basics\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Wildside\Userstamps\Userstamps;

class Destination extends Model
{
    use HasFactory;
    use Userstamps;

    protected $fillable = ['costcenter', 'name', 'address', 'phone', 'location', 'minimun', 'maximun'];

    protected $table = 'basic_destinations';
    
    protected static function newFactory()
    {
        return \Modules\Basics\Database\factories\DestinationFactory::new();
    }

    protected $casts = [
        'created_at' => 'datetime:Y-m-d h:m:s',
        'updated_at' => 'datetime:d-m-Y h:m:s',
    ];

    public function QueryTable($keyWord = null, $sortField, $sortDirection)
    {
        return $this->select('id','costcenter', 'name', 'address', 'phone', 'location', 'minimun', 'maximun')        
        ->search('name', $keyWord)
        ->search('costcenter', $keyWord)
        ->search('address', $keyWord)        
        ->orderBy($sortField, $sortDirection);         
    }
}
