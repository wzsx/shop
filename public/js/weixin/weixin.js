$("#text").click(function(e){
    e.preventDefault();
    var opess= $("#opess").val();


    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url     :   '/weixin/hll',
        type    :   'post',
        data    :   {opess:opess},
        dataType:   'json',
        success :   function(d){
            if(d.error!==0){
                alert(d.msg);
                window.location.href='/weixin/huliao';
            }else{
                window.location.href=d.url;
            }
        }
    });
});

