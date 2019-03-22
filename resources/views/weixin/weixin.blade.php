@extends('layouts.bst')


@section('content')
    <form  action="/form/test" method="post" enctype="multipart/form-data" >
        {{--<input type="text" name="fs">--}}
        <h1>上传</h1>
        {{csrf_field()}}
        <input type="file" name="media">
        <button type="submit" class="btn btn-default">上传</button>
    </form>
@endsection




