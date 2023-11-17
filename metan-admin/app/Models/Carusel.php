<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use TCG\Voyager\Models\Page;
use TCG\Voyager\Traits\Translatable;

class Carusel extends Model
{
    use HasFactory,Translatable;
    protected $table = 'carusel';
    protected $primaryKey = 'id';
    protected $fillable = ['category_name','title','description','image'];

    protected $translatable = ['category_name','title','description'];

    public static function findBySlug($slug)
    {
        return static::withTranslations(Session::get('locale'))->where('slug',$slug)->first();
    }

}
