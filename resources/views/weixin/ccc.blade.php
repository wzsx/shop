<form  action="/weixin/createss" method="post" enctype="multipart/form-data" >
<table>
    <script src="/js/jquery-1.12.4.min.js"></script>
    <tr>
        <td><button type="submit" class="btn btn-default">一级按钮</button>名字:<input type="text" name="name"> <input type="button" value="克隆" style="width: 50px;" class="btn"></td>
    </tr>
    <tr><td><button type="submit" class="btn btn-default">二级按钮</button> 按钮类型:     <select name="" id="cd">
                <option value="">请选择</option>
                <option value="">一级按钮</option>
                <option value="">二级按钮</option>
            </select>
        二级按钮名字:<input type="text">二级按钮url:<input type="text">二级按钮名字key:<input type="text"><input type="button" value="克隆" style="width: 50px;" class="btn1"></td></tr>
    <button type="submit" class="btn btn-default">发布</button>
</table>
</form>
<script>
    $(function(){
        $(document).on('click','.btn',function(){
            var _this=$(this);
            var _val=_this.val();
            if(_val=='克隆'){
                var _tr=_this.parents('table').clone();
                _this.parents('table').after(_tr);
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