<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Photo extends Model
{
    public function albums(){
        return $this->belongsTo(Album::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function getPathAttribute(){

        $url=$this->img_path;
        if(stristr($url,'http')===false){
            $url='storage/'.$url;
        }
        return $url;
    }
}
