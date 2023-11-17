<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;

class About extends Model
{
    use HasFactory,Translatable;
    protected $table = 'about';
    protected $primaryKey = 'id';
    protected $fillable = ['image','description'];

    protected $translatable = ['description'];
}
