<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{


    /* relations */

    public function posts() {
        return $this->belongsToMany('App\Post');
    }

}
