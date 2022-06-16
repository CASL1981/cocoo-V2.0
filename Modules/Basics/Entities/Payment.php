<?php

namespace Modules\Basics\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Wildside\Userstamps\Userstamps;

class Payment extends Model
{
    use HasFactory;
    use Userstamps;

    protected $table = 'basic_payments';

    protected $fillable = ['name', 'typeinterval','quotas', 'interval'];
    
    protected static function newFactory()
    {
        return \Modules\Basics\Database\factories\PaymentFactory::new();
    }

    protected $casts = [
        'created_at' => 'datetime:Y-m-d h:m:s',
        'updated_at' => 'datetime:d-m-Y h:m:s',
    ];

    
    public function QueryTable($keyWord = null, $sortField, $sortDirection)
    {
        return $this->select('id','name', 'typeinterval', 'quotas', 'interval')
        ->search('name', $keyWord)
        ->orderBy($sortField, $sortDirection); 
    }
}
