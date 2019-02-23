<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meisai extends Model{
    /**
     * MeisaiクラスとUserクラスは多対1の関係
     *
     * @return Illuminate\Database\Eloquent\Model
     */
    public function user(){
        return $this->belongsTo('App\User', 'email', 'email');
    }
}
