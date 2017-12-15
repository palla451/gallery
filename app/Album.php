<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    public function users(){
        return $this->belongsTo(User::class);
    }
}
