<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;

class Information extends Model
{
    use HasFactory,Translatable;
    protected $table = 'information';
    protected $primaryKey = 'id';
    protected $fillable = ['name','work_days','phone','email','address',];

    protected $translatable = ['name','work_days','phone','email','address'];
}
