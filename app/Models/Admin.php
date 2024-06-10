<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable
{
    use SoftDeletes, HasFactory,Notifiable , HasRoles;
    public $translatable = ['name'];
    protected $guard = 'admin';


    protected  $guarded=[];
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = ['deleted_at'];


    public function getImageAttribute($value)
    {
        if (isset($value))
            return url('storage') . '/admins/' . $value;

        return null;
    }
}
