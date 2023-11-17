<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;

class Location extends Model
{
    use HasFactory,Translatable;
    protected $table = 'location';
    protected $primaryKey = 'id';
    protected $fillable = ['title','address','phone','icon'];

    protected $translatable = ['title','address','phone'];
}
