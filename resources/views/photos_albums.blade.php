@extends('template.layout')

@section('content')
    {{csrf_field()}}

    <table class="table">
        <h1>Album name: {{$albums->album_name}}</h1>
        <h4>Author: {{$users->name}}</h4>
        <p>
            <a href="/photos/{{$albums->id}}/create">
                <button type="button" class="btn btn-primary btn-md">new photo</button>
            </a>
        </p>


        <tr>
            <th>NAME IMAGE</th>
            <th>DESCRIPTION</th>
            <th>IMAGE</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>

        @foreach($photos as $photo)
            <tr>
                <td><b>{{$photo->name}}</b></td>
                <td>{{$photo->description}}</td>
                <td><img src="{{asset($photo->img_path)}}" width="480"></td>
                <td>
                    <a href="/photos/{{$photo->id}}/delete">
                        <button type="button" class="btn btn-danger btn-primary btn-md">delete</button>
                    </a>
                </td>
                <td>
                    <a href="/photos/{{$photo->id}}/edit">
                        <button type="button" class="btn btn-primary btn-md">update</button>
                    </a>
                </td>

            </tr>
        @endforeach

    </table>





@endsection