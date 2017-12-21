@extends('template.layout')

@section('content')


    <form action="/albums/save" method="POST" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="form-group">
            <label class="col-form-label">Album Name</label>
            <input name="album_name" type="text" class="form-control" id="album_name" placeholder="Album Name">
        </div>

        <div class="form-group">
            <label class="col-form-label">Description</label>
            <textarea type="text-area" name="description" class="form-control" id="description" placeholder="description"></textarea>
        </div>

        <div class="form-group">
            <label class="col-form-label">Album Thumb</label>
            <input type="file" style="background-color: #F5F8FA;" name="album_thumb"  id="album_thumb" placeholder="Album Thumb">
        </div>

        <button type="submit" class="btn btn-lg btn-primary">Submit</button>
    </form>


@endsection