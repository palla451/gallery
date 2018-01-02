<?php

namespace App\Http\Controllers;
use App\Album;
use App\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AlbumController extends Controller
{
    /* regole validazione */

    protected $rules =[
        'album_name'  => 'required',
        'description' => 'required'
    ];

    protected $errorMessages =[
        'album_name.required'  => 'Nome album è obbligatorio',
        'description.required' => 'La descrizione è obbligatorio'
    ];

    public function index(){

        // $albums = Album::orderBy('id','DESC')->paginate(8);

        $albums = Album::orderBy('id','DESC')
                         ->where('user_id','=',Auth::user()->id)->paginate(8);

        return view('albums',[
            'albums'=>$albums
        ]);
    }

    public function delete($id){
        $albums = Album::find($id);
        $data = substr($albums->album_thumb, 0, 4);
        $this->deleteDirectory($albums->id);
        if($data !== 'http')
            Storage::disk('public')->delete('/'.$albums->album_thumb);
        $albums->delete();
        return redirect('albums');
    }

    public function edit($id){
        $albums = Album::find($id);
        return view('albums_update',['albums'=>$albums]);
    }

    public function update($id,Request $request){
        $albums = Album::find($id);

        $this->validate($request, $this->rules, $this->errorMessages);

        $albums->album_name = $request->input('album_name');
        $albums->description = $request->input('description');
        $this->processFile($albums,$request);
        $albums->update();
        return redirect('albums');
    }

    public function create(){
        $albums = new Album();
        return view('albums_create',['albums'=>$albums]);
    }

    public function save(Request $request){

        $this->validate($request, $this->rules, $this->errorMessages);

        $albums = new Album();
        $albums->album_name = $request->input('album_name');
        $albums->description = $request->input('description');
        $albums->album_thumb = env('ALBUM_THUMB_DIR').'/'.'no_image.png';
        $albums->user_id = Auth::user()->id;
        $res=$albums->save();
        $this->processFile($albums, $request);
        $albums->save();
        return redirect('albums');
    }

    public function processFile($albums,Request $request){
        if($request->hasFile('album_thumb')){
            $file= $request->file('album_thumb');
            $fileName= $albums->id.'.'.$file->extension();
            $file->storeAs(env('ALBUM_THUMB_DIR'),$fileName,'public');
            $albums->album_thumb= env('ALBUM_THUMB_DIR').'/'.$fileName;
        }
    }

    public function deleteDirectory($id){
        $photos = Photo::where('album_id','=',$id)->get();
        foreach($photos as $photo){
            $path = substr($photo['img_path'], 0, 4);
            if ($path !== 'http')
                Storage::disk('public')->deleteDirectory(env('IMG_DIR').'/'.$id);
        }
    }
}
