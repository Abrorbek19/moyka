<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;

class Service extends Model
{
    use HasFactory,Translatable;
    protected $table = 'service';
    protected $primaryKey = 'id';
    protected $fillable = ['title','description','image'];

    protected $translatable = ['title','description'];
}
