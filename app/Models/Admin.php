<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Admin extends Authenticatable
{
    use SoftDeletes, HasFactory;
    public $translatable = ['name'];


    protected $fillable = [
        'name', 'user_name', 'phone_number', 'is_active', 'image', 'email', 'email_verified_at', 'password'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = ['deleted_at'];


    public function getImageAttribute($value)
    {
        if (isset($value))
            return url('storage') . '/' . $value;

        return null;
    }
}
