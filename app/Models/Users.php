<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;

class Users extends Model implements Authenticatable
{
    use HasFactory, AuthenticableTrait;

    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $hidden = ['password'];
    public $timestamps = ['created_at', 'updated_at'];

    protected $fillable = ['name', 'email', 'password', 'user_type', 'profile_picture'];

    public function orders()
    {
        return $this->hasMany(Order::class, 'user_id');
    }
}
