<?php

namespace App\Http\Controllers;
use App\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AlbumController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        $albums = Album::orderBy('id','DESC')->paginate(8);
        //dd($albums);
        return view('albums',['albums'=>$albums]);
    }

    /*
     public function delete($id){
        $albums = Album::find($id);
        $albums->delete();
        return redirect('albums');
    }
     */

    public function delete($id){
        $albums = Album::find($id);
        $thumb = $albums->album_thumb;
        $data = substr($thumb, 0, 4);
        // se è caricata un'immagine nel db cancellala //
        if($data !== 'http'){
            Storage::disk('public')->delete('/'.$thumb);
        }

        $albums->delete();
        return redirect('albums');
    }

    public function edit($id){
        $albums = Album::find($id);
        return view('albums_update',['albums'=>$albums]);
    }

    public function update($id,Request $request){
        $albums = Album::find($id);
        $albums->album_name = $request->input('album_name');
        $albums->description = $request->input('description');

        if ($request->hasFile('album_thumb')){
            $file = $request->file('album_thumb');
            $fileName= $id.'.'.$file->extension();
            $file->storeAs(env('ALBUM_THUMB_DIR'),$fileName,'public');
            $albums->album_thumb= env('ALBUM_THUMB_DIR').'/'.$fileName;
        }
        $albums->update();

        return redirect('albums');
    }

    public function create(){
        $albums = new Album();
        return view('albums_create',['albums'=>$albums]);
    }

    public function save(Request $request){
        $albums = new Album();
        $albums->album_name = $request->input('album_name');
        $albums->description = $request->input('description');
        $albums->album_thumb = env('ALBUM_THUMB_DIR').'/'.'no_image.png';
        $albums->user_id= Auth::user()->id;
        $res=$albums->save();

        if ($request->hasFile('album_thumb')){
            $file= $request->file('album_thumb');
            $fileName= $albums->id.'.'.$file->extension();
            $file->storeAs(env('ALBUM_THUMB_DIR'),$fileName,'public');
            $albums->album_thumb= env('ALBUM_THUMB_DIR').'/'.$fileName;
            $albums->save();
            return redirect('albums');
        } else{
            $albums->save();
            return redirect('albums');
        }
    }
}
