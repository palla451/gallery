<?php

namespace App\Http\Controllers;

use App\User;
use App\Photo;
use App\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;


class PhotoController extends Controller
{
    public function show($id){
        $photos = Photo::orderBy('album_id')->where('album_id','=',$id)->get();
        $albums = Album::find($id);
        $users = User::find($albums->user_id);
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
        $img = $photos->img_path;
        $data = substr($img, 0, 4);
        if($data !== 'http')
            Storage::disk('public')->delete($img);
        $photos->delete();
        return redirect('/albums/'.$key.'/photos');
    }

    public function edit($id){
        $photos = Photo::find($id);
        return view('photos_update',['photos'=>$photos]);
    }

    public function update($id,Request $request){
        $photos = Photo::find($id);
        $this->processFile($photos, $request);
        $photos->name = $request->input('name');
        $photos->description = $request->input('description');
        $photos->update();
        return redirect('/albums/'.$photos->album_id.'/photos');
    }

    public function create($id){
        $photos = new Photo();
        $albums = Album::find($id);
        return view('photos_create',
            [
                'photos'=>$photos,
                'albums'=>$albums,
            ]);
    }

    public function save(Request $request){
        $photos = new Photo();
        $photos->name = $request->input('name');
        $photos->description = $request->input('description');
        $photos->img_path = env('ALBUM_THUMB_DIR').'/'.'no_image.png';
        $photos->album_id = $request->input('album_id');
        $res = $photos->save();
        $this->processFile($photos, $request);
        $photos->save();
        return redirect('/albums/'.$photos->album_id.'/photos');
    }

    public function processFile($photos,Request $request){
        if($request->hasFile('img_path')){
            $file= $request->file('img_path');
            $fileName= $fileName = $photos->id.'.'.$file->extension();
            $file->storeAs(env('IMG_DIR').'/'.$photos->album_id,$fileName,'public');
            $photos->img_path = env('IMG_DIR').'/'.$photos->album_id.'/'.$fileName;
        }
    }
}


