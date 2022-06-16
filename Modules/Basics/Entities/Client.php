<?php

namespace Modules\Basics\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Wildside\Userstamps\Userstamps;

class Client extends Model
{
    use HasFactory;
    use Userstamps;

    protected $fillable = ['identification', 'first_name', 'last_name', 'client_name','status', 'type_document', 
                        'address', 'phone', 'cel_phone', 'entry_date', 'email', 'gender', 'type', 'birth_date', 'limit',
                        'vendedor_id', 'typeprice_id', 'shoppingcontact', 'conditionpayment_id', 'created_by', 'updated_by'];

    protected $table = 'basic_clients';
    
    protected static function newFactory()
    {
        return \Modules\Basics\Database\factories\ClientFactory::new();
    }

    public function getStatusColorAttribute()
    {
        return [
            '1' => 'success',
            '0' => 'danger',
        ][$this->status] ?? 'info';
    }

    protected $casts = [
        'created_at' => 'datetime:Y-m-d h:m:s',
        'updated_at' => 'datetime:d-m-Y h:m:s',
    ];

    public function QueryTable($keyWord = null, $sortField, $sortDirection)
    {
        return $this->select('id','identification', 'first_name', 'last_name', 'client_name','status', 'type_document', 
                            'address', 'phone', 'cel_phone', 'entry_date', 'email', 'gender', 'type', 'birth_date', 'limit',
                            'vendedor_id', 'typeprice_id', 'shoppingcontact', 'conditionpayment_id')
        ->search('identification', $keyWord)
        ->search('first_name', $keyWord)
        ->search('last_name', $keyWord)
        ->search('client_name', $keyWord)
        ->orderBy($sortField, $sortDirection); 
    }
}
