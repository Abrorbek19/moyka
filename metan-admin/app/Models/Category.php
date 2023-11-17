<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use TCG\Voyager\Traits\Translatable;

class Category extends Model
{
    use HasFactory,Translatable;
    protected $table = 'category';
    protected $primaryKey = 'id';
    protected $fillable = ['category','title','description'];
    protected $translatable = ['title','description'];

    public static function findBySlug($slug)
    {
        return static::withTranslations(Session::get('locale'))->where('slug',$slug)->first();
    }
}
