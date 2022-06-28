<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilesUser extends Model
{
    use HasFactory;
    protected  $table = 'profiles_user';
    protected $fillable = ['profiles_id', 'user_id'];
}