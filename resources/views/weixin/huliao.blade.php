@extends('layouts.bst')


@section('content')
    <form  action="/form/hll" method="post" enctype="multipart/form-data" >
        <h1>客服管理</h1>
        <h2>聊天记录</h2>
        <textarea name="fs" id="opsen" cols="30" rows="10"></textarea><br>
        {{csrf_field()}}
        <h2>发送内容</h2>
        <input type="text" id="opess" name="ts"><br>
        <button type="submit" class="btn btn-default">发送</button>
    </form>
@endsection
@section('footer')
    @parent
    <script src="{{URL::asset('/js/weixin/weixin.js')}}"></script>
@endsection




