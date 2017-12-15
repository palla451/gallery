@extends('template.layout')

@section('content')


    <form action="/albums/{{$albums->id}}/update" method="POST">
        {{csrf_field()}}
        <input type="hidden" name="_method" value="PATCH">
        <div class="form-group">
            <label class="col-form-label">Album Name</label>
            <input value="{{$albums->album_name}}" name="album_name" type="text" class="form-control" id="album_name" placeholder="Album Name">
        </div>
        <div class="form-group">
            <label class="col-form-label">Description</label>
            <textarea type="text-area" name="description" class="form-control" id="description" placeholder="description">{{$albums->description}}</textarea>
        </div>
        <div class="form-group">
            <label class="col-form-label">Image</label>
            <p><img src="{{asset($albums->album_thumb)}}" width="240px"></p>
        </div>
        <button type="submit" class="btn btn-lg btn-primary">Submit</button>
    </form>


    @endsection