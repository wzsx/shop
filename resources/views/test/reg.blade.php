<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>用户注册</title>
</head>
<body>
    <form action="/userreg" method="post">
        {{csrf_field()}}
        用户名：<input type="text" name="u_name"><br>
        Email：<input type="text" name="u_email"><br>
        密码：<input type="text" name="u_pwd"><br>
        <input type="submit" value="提交">
    </form>
</body>
</html>
