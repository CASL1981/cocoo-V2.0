<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'identification', 
        'position', 
        'profession', 
        'bio', 
        'address', 
        'phone', 
        'facebook', 
        'twitter',
        'instagram',
        'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
