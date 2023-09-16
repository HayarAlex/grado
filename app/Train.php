<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Train extends Model
{
    //train
    protected $table = 'trains';
    protected $primaryKey = 'train_id';

    public function sport(){
        return $this->belongsTo(Sport::class,'sport_id');
    }
    public function coach(){
        return $this->belongsTo(User::class,'id');
    }
}
