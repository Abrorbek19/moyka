<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;

class Items extends Model
{
    use HasFactory,Translatable;
    protected $table = 'items';
    protected $primaryKey ='id';
    protected $fillable = ['category','icon','title'];

    protected $translatable = ['title'];
}
