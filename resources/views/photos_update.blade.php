@extends('template.layout')

@section('content')


    <form action="/photos/{{$photos->id}}/update" method="POST" enctype="multipart/form-data">

        {{csrf_field()}}

        <input type="hidden" name="_method" value="PATCH">

        <div class="form-group">
            <label class="col-form-label">Name</label>
            <input value="{{$photos->name}}" name="name" type="text" class="form-control" id="name" placeholder="Album Name">
        </div>

        <div class="form-group">
            <label class="col-form-label">Description</label>
            <textarea type="text-area" name="description" class="form-control" id="description" placeholder="description">{{$photos->description}}</textarea>
        </div>

        <div class="form-group">
            <label class="col-form-label">Image</label>
            <input type="file" style="background-color: #F5F8FA;" name="img_path"  id="img_path" placeholder="img_path">
        </div>

        <div class="form-group">
            <p><img src="{{$photos->img_path}}" width="240px"></p>
        </div>

        <button type="submit" class="btn btn-lg btn-primary">Submit</button>
    </form>


@endsection