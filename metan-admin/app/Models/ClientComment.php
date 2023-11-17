<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;

class ClientComment extends Model
{
    use HasFactory,Translatable;
    protected $table = 'client_comment';
    protected $primaryKey = 'id';
    protected $fillable =['name','job','image','comment'];

    protected $translatable = ['name','job','comment'];
}
