<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thế Giới Nước Hoa Của Tôi</title>
</head>
<body>
    <h1 style="color: red">Xác Nhận Tài Khoản</h1>
    <p>Xin chào {{$data['ho_ten']}},</p>
    <p>Chúc mừng bạn đã hoàn thành thông tin đăng ký tài khoản Thế Giới Nước Hoa Của Tôi.</p>
    <p>Dưới đây là thông tin tài khoản đã tạo:</p>
    <p>- Tài khoản: {{$data['email']}}</p>
    <p>- Mật khẩu: {{$data['mat_khau']}}</p>
    <p>Cảm ơn bạn đã tin dùng sản phẩm của chúng tôi. Click <a href="{{$data['route']}}">vào đây</a> để xác thực tài khoản.</p>
</body>
</html>