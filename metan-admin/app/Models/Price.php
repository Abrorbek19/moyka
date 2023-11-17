<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;

class Price extends Model
{
    use HasFactory, Translatable;

    protected $table = 'price';
    protected $primaryKey = 'id';
    protected $fillable = ['icon','basic_money','addition_money','category'];

    protected $translatable = ['icon','basic_money','addition_money','title'];
}

