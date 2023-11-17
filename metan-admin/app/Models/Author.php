<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;

class Author extends Model
{
    use HasFactory,Translatable;

    protected $table = 'author';
    protected $primaryKey = 'id';
    protected $fillable = ['name','description','image'];

    protected $translatable = ['name','description'];
}
