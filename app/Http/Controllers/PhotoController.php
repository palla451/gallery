<?php

namespace App\Http\Controllers;

use App\User;
use App\Photo;
use App\Album;
use Illuminate\Http\Request;


class PhotoController extends Controller
{
    public function show($id){
        $photos = Photo::orderBy('album_id')->where('album_id','=',$id)->get();
        $albums = Album::find($id);
        $key= $albums->user_id;
        $users = User::find($key);

        return view('photos_albums',
        [
            'photos'=>$photos,
            'albums'=>$albums,
            'users' =>$users,
        ]);
    }

    public function delete($id){
        $photos = Photo::find($id);
        $key = $photos->album_id;
        $photos->delete();
        return redirect('/albums/'.$key.'/photos');
    }

    public function edit($id){
        $photos = Photo::find($id);
        return view('photos_update',['photos'=>$photos]);
    }

    public function update($id,Request $request){
        $photos = Photo::find($id);
        $key = $photos->album_id;
        $photos->name = $request->input('name');
        $photos->description = $request->input('description');

        if ($request->hasFile('img_path')){
            $file= $request->file('img_path');
            $fileName = $id.'.'.$file->extension();
            $file->storeAs(env('IMG_DIR').'/'.$key,$fileName,'public');
            $photos->img_path = '/storage/'.env('IMG_DIR').'/'.$key.'/'.$fileName;
        }
        $photos->update();
        return redirect('/albums/'.$key.'/photos');
    }
}


