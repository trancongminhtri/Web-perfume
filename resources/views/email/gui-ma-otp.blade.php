<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thế Giới Nước Hoa Của Tôi</title>
</head>
<body>
    <h1 style="color: red">Mã OTP</h1>
    <p>Xin chào {{$data['ho_ten']}},</p>
    <p>Mã OTP của bạn cho việc lấy lại mật khẩu là: <span style="color: red">{{$data['ma_otp']}}</span></p>
    <p>Cảm ơn bạn đã tin dùng sản phẩm của chúng tôi. Nhập mã OTP để chúng tôi xác nhận và gửi bạn mật khẩu mới.</p>
</body>
</html>