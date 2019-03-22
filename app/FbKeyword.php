<?php

namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

class FbKeyword extends Eloquent
{
    protected $table = "fb_interests_keys";

    protected $fillable = ['keyword'];

    public function interests()
    {
        return $this->hasMany('App\Fb');
    }
}
