<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsEmail extends Model
{
    use HasFactory;
    protected $table = 'news_email';
    protected $primaryKey = 'id';
    protected $fillable = ['full_name','email'];
}
