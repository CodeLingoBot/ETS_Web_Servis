<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class users extends Model
{
	public $timestamps=False;

    public function memorize(){
    	return $this->hasMany('App\memorize');
    }
    public function word(){
    	return $this->hasMany('App\word');
    }

}
