<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    public function users(){
        return $this->belongsTo(User::class);
    }

     public function getPathAttribute(){

        $url=$this->album_thumb;
        if(stristr($url,'http')===false){
            $url='storage/'.$url;
        }
        return $url;
    }


}
