@extends('template.layout')

@section('content')
    {{csrf_field()}}

<table class="table">
    <tr>
        <th>ALBUM NAME</th>
        <th>DESCRIPTION</th>
        <th>THUMBS</th>
        <th></th>
        <th></th>
        <th></th>
    </tr>

        @foreach($albums as $album)

        <tr>
            <td><b>{{$album->album_name}}</b></td>
            <td>{{$album->description}}</td>
            <td><img src="{{asset($album->path)}}" width="100"></td>
            <td>
                <a href="/albums/{{$album->id}}/delete">
                    <button type="button" class="btn btn-danger btn-primary btn-md">delete</button>
                </a>
            </td>
            <td>
                <a href="/albums/{{$album->id}}/edit">
                    <button type="button" class="btn btn-primary btn-md">update</button>
                </a>
            </td>
            <td>
                <a href="/albums/{{$album->id}}/photos">
                    <button type="button" class="btn btn-info btn-primary btn-md">show</button>
                </a>
            </td>
        </tr>
        @endforeach


</table>

    {{$albums->links()}}

@endsection
