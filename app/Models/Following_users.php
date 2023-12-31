<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Following_users extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'followingUser',
    ];

    public function followers(){
        return $this->hasMany(User::class);
    }
}
