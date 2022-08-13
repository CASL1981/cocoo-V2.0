<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function leads()
    {
        return $this->hasMany(Lead::class);
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function scopeTypeOfTask(Builder $query)
    {
        return $query->where('module_type', $this->module);
    }

    public function scopeTypeOfStatus(Builder $query)
    {
        return $query->where('module_type', $this->module);
    }

}
