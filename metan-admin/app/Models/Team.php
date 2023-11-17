<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;

class Team extends Model
{
    use HasFactory,Translatable;
    protected $table = 'team';
    protected $primaryKey = 'id';
    protected $fillable = ['name','job','image','telegram_link','instagram_link','twitter_link','linkedin_link','facebook_link'];

    protected $translatable = ['name','job'];
}
