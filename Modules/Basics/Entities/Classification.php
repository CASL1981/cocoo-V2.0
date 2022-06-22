<?php

namespace Modules\Basics\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class Classification extends Model
{
    use HasFactory;
    use Userstamps;
    use SoftDeletes;

    protected $fillable = ['code', 'level', 'parent', 'name', 'impute'];

    protected $table = 'basic_classifications';

    protected static function newFactory()
    {
        return \Modules\Basics\Database\factories\ClassificationFactory::new();
    }

    protected $casts = [
        'created_at' => 'datetime:Y-m-d h:m:s',
        'updated_at' => 'datetime:d-m-Y h:m:s',
        'deleted_at' => 'datetime:d-m-Y h:m:s',
    ];
    
    public function QueryTable($keyWord = null, $sortField, $sortDirection)
    {
        return $this->select('id','code', 'level', 'parent', 'name', 'impute')
        ->search('name', $keyWord)
        ->orderBy($sortField, $sortDirection); 
    }
}
