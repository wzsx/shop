@extends('layouts.bst')

@section('content')
    <div class="container">
        <h3>未支付订单：</h3>
        <ul>
            @foreach($list as $k=>$v)
                <li>订单ID: {{$v['order_sn']}} --  订单总价：¥{{$v['order_amount'] / 100}}   --  下单时间：{{date('Y-m-d H:i:s',$v['add_time'])}}
                    <a href="/pay/o/{{$v['oid']}}" class="btn btn-info">支付宝支付</a><br><br>
                    <a href="/weixin/o/{{$v['oid']}}" class="btn btn-info">微信支付</a><br><br>
                    {{--<a href="/order/del/{{$v['oid']}}" class="del_goods">删除</a>--}}
                </li>
            @endforeach
        </ul>
    </div>
@endsection