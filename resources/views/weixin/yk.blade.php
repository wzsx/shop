@extends('layouts.bst')

<script src="/js/jquery-1.12.4.min.js"></script>
@section('content')
    <button type="submit" class="btn btn-default">一级按钮</button>名字:<input type="text">  <button type="submit" value="克隆" class="btn">克隆</button>
    <br>
    <button type="submit" class="btn btn-default">二级按钮</button>  <button type="submit" class="btn btn-default">克隆</button>
    <br>
          按钮类型:     <select name="" id="cd">
                        <option value=""></option>
                        <option value="">一级按钮</option>
                        <option value="">二级按钮</option>
    </select>
    <br>
          二级按钮名字:<input type="text">
    <br>
          二级按钮url:<input type="text">
    <br>
          二级按钮名字key:<input type="text">
@endsection
<script>
    $(function(){
        $(function(){
            $(document).on('click','.btn',function(){
                var _this=$(this);
                var _val=_this.val();
                if(_val=='克隆'){
                    var _button=_this.parents('button').clone();
                    _this.parents('button').after(_button);
                }
            })
        })


</script>