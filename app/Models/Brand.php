<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Brand extends Model
{
    use HasFactory, SoftDeletes,HasTranslations;
    public $translatable = ['description'];

    protected  $guarded=[];

    protected $dates = ['deleted_at'];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'deleted_at',
    ];
    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public function getImageAttribute($value)
    {
        if (isset($value))
            return url('storage') . '/brands/' . $value;

        return null;
    }
}
