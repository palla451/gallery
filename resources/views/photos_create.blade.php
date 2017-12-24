@extends('template.layout')

@section('content')


    <form action="/photos/save" method="POST" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="form-group">
            <label class="col-form-label">Photo name</label>
            <input name="name" type="text" class="form-control" id="name" placeholder="Photo name">
        </div>

        <div class="form-group">
            <label class="col-form-label">Description</label>
            <textarea type="text-area" name="description" class="form-control" id="description" placeholder="description"></textarea>
        </div>

        <div class="form-group">
            <label class="col-form-label">Album name:</label>
                <h4>{{$albums->album_name}}</h4></b>
        </div>

        <div class="form-group" hidden>
            <label class="col-form-label">Album id</label>
            <textarea type="input" name="album_id" class="form-control" id="album_id" placeholder="album_id">{{$albums->id}}</textarea>
        </div>


        <div class="form-group">
            <label class="col-form-label">Image</label>
            <input type="file" style="background-color: #F5F8FA;" name="img_path"  id="album_thumb" placeholder="Image">
        </div>

        <button type="submit" class="btn btn-lg btn-primary">Submit</button>
    </form>


@endsection