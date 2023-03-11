<?php

namespace Modules\Basics\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Wildside\Userstamps\Userstamps;

class Sequence extends Model
{
    use HasFactory;
    use Userstamps;

    protected $table = 'basic_sequences';

    protected $fillable = ['document', 'document_name', 'number'];
    
    protected static function newFactory()
    {
        return \Modules\Basics\Database\factories\SequenceFactory::new();
    }
    
    protected $casts = [
        'created_at' => 'datetime:Y-m-d h:m:s',
        'updated_at' => 'datetime:d-m-Y h:m:s',
    ];
    
    public function QueryTable($keyWord = null, $sortField, $sortDirection)
    {
        return $this->select('id','document_name', 'document', 'number')
        ->search('document_name', $keyWord)
        ->search('document', $keyWord)
        ->orderBy($sortField, $sortDirection); 
    }
}
