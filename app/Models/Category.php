<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Category extends Model
{
    use HasFactory, SoftDeletes, HasTranslations;

    public $translatable = ['name', 'description'];

    protected  $guarded=[];

    protected $dates = ['deleted_at'];


    public static function getParentCategories()
    {
        return self::where('parent_id', null)->get();
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }


    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
    public function isNotParent()
    {
        return !$this->children()->exists();
    }
    public function getImageAttribute($value)
    {
        if (isset($value))
            return url('storage') . '/' . $value;

        return null;
    }
}
