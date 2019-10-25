<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LignePage extends Model
{
    //
    public function page(){
        return $this->belongsTo('App\Page');
    }

}
