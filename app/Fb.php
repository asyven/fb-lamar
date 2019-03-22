<?php

namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Fb extends Eloquent
{
    protected $table = "fb";

    protected $fillable = ['keyword','fb_id', 'name', 'audience_size', 'path', 'description', 'topic'];

    protected $hidden = ['id','updated_at','created_at','keyword'];

    public function getPathAttribute($value)
    {
        return json_decode($value,true);
    }
}
