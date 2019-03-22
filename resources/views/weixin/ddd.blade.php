@extends('layouts.bst')


@section('content')
    <script src="/js/jquery-1.12.4.min.js"></script>
    <tr>
        <td><button type="submit" class="btn btn-default">一级按钮</button>名字:<input type="text" name="name"> <input type="button" value="克隆" style="width: 50px;" class="btn"></td>
    </tr><br>
    <tr><td><button type="submit" class="btn btn-default">二级按钮</button>   <input type="button" value="克隆" style="width: 50px;" class="btn1"></td></tr>
    <br>
    <tr><td>按钮类型:     <select name="" id="cd">
                <option value="">请选择</option>
                <option value="">一级按钮</option>
                <option value="">二级按钮</option>
            </select></td>
    </tr><br>
    <tr>
        <td>二级按钮名字:<input type="text"></td>
    </tr><br>
    <tr>
        <td>二级按钮url:<input type="text"></td>
    </tr><br>
    <tr>
        <td>二级按钮名字key:<input type="text"></td>
    </tr>
@endsection
<script>
    $(function(){
        $(document).on('click','.btn',function(){
            var _this=$(this);
            var _val=_this.val();
            if(_val=='克隆'){
                var _tr=_this.parents('tr').clone();
                _this.parents('tr').after(_tr);
            }
        })
        $(document).on('click','.btn1',function(){
            var _this=$(this);
            var _val=_this.val();
            if(_val=='克隆'){
                var _tr=_this.parents('tr').clone();
                _this.parents('tr').after(_tr);
            }
        })
    })
</script>