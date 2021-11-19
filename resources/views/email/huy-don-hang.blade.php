<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thế Giới Nước Hoa Của Tôi</title>
    <style>
        * {
            box-sizing: border-box;
            padding: 0;
            margin: 0;
            font-size: 14px;
            font-weight: 400;
            font-family: Arial, Helvetica, sans-serif;
        }

        .email-title {
            margin-top: 4px;
            margin-left: 4px;
        }

        .email-title2 {
            margin-top: 12px;
            margin-left: 4px;
        }

        .email-title__greet-first {
            font-size: 14px;
        }

        .email-title__info-order {
            margin-left: 8px;
            margin-top: 4px;
        }

        .email-title__info-recieve {
            margin-left: 12px;
            margin-top: 8px;
        }

        .info-recieve__title {
            font-weight: 600;
        }

        .info-recieve__inf {
            margin-left: 16px;
            font-weight: 600;
            margin-top: 4px;
        }

        .info-recieve__inf span {
            font-style: italic;
            font-weight: 500;
        }

        .email-content {
            margin-left: 12px;
            margin-top: 12px;
        }

        .info-order__title {
            font-weight: 600;
            margin-top: 4px;
        }

        .info-order__title span {
            font-weight: 400;
            font-style: italic;
        }

        table {
            width: 96%;
            margin: 12px 8px;
        }

        .email-title__product th {
            font-weight: 600;
            border: 0.5px solid #333;
            padding: 6px;
        }

        .email-content__product {
            margin-top: 4px;

        }

        .email-content__product td {
            text-align: center;
            border: 0.5px solid #333;
            padding: 0px 2px;

        }

        @media (max-width: 739px) {
            .email-content__product-name {
                font-size: 14px;
                line-height: 16px;
                height: 48px;
                display: -webkit-box;
                -webkit-box-orient: vertical;
                -webkit-line-clamp: 3;
                overflow: hidden;
            }
        }
    </style>
</head>

<body>
    <div class="email-title">
        <p class="email-title__greet-first">Chào bạn {{$data['don_hang']->ten_khach_hang}}!</p>
        <p class="email-title__info-order">Perfume T&T gửi đến bạn thông tin đơn hàng:</p>
        <div class="email-title__info-recieve">
            <p class="info-recieve__title">Thông tin nhận hàng:</p>
            <p class="info-recieve__inf">Họ Tên: <span>{{$data['don_hang']->ten_khach_hang}}</span></p>
            <p class="info-recieve__inf">Số điện thoại: <span>{{$data['don_hang']->sdt}}</span></p>
            <p class="info-recieve__inf">Địa chỉ: <span>{{$data['don_hang']->dia_diem}}</span></p>
        </div>
    </div>
    <div class="email-content">
        <p class="info-order__title">Mã đơn hàng: <span>{{$data['don_hang']->id}}</span></p>
        <p class="info-order__title">Trạng thái: <span>{{$data['trang_thai']}}</span></p>
        <p>Xin lỗi, chúng tôi không thể thực hiện đơn hàng {{$data['don_hang']->id}}. Đơn hàng này sẽ được hủy. Nếu có thắc mắc, thông tin liên hệ được đính kèm bên dưới!</p>
    </div>
    <table>
        <tr class="email-title__product">
            <th style="width:50%">Sản phẩm</th>
            <th style="width:13.333%">Đơn giá</th>
            <th style="width:10%">Số lượng</th>
            <th style="width:13.333%">Khuyến mãi</th>
            <th style="width:13.333%">Thành tiền</th>
        </tr>
        @foreach($data['ds_chi_tiet'] as $chi_tiet)
        <tr class="email-content__product">
            <td class="email-content__product-name">{{$chi_tiet['ten_nuoc_hoa']}}</td>
            <td>{{number_format($chi_tiet['gia_tien_goc'])}}vnđ</td>
            <td>{{$chi_tiet['so_luong_san_pham']}}</td>
            <td>{{number_format($chi_tiet['gia_tien_km'])}}vnđ</td>
            <td>{{number_format($chi_tiet['thanh_toan'])}}vnđ</td>
        </tr>
        @endforeach
    </table>
    <div class="email-title__info-recieve">
        <p class="info-recieve__inf">Tổng tiền: <span>{{number_format($data['don_hang']->tong_tien)}}vnđ</span></p>
        <p class="info-recieve__inf">Tổng khuyến mãi: <span>{{number_format($data['don_hang']->tong_tien_giam)}}vnđ</span></p>
        <p class="info-recieve__inf">Tổng số lượng: <span>{{number_format($data['don_hang']->tong_so_luong)}}</span></p>
        <p class="info-recieve__inf">Tổng thanh toán: <span>{{number_format($data['don_hang']->tong_thanh_toan)}}vnđ</span></p>
    </div>
    <div class="email-title2">
        <p class="email-title__greet-first">Xin chân thành cảm ơn và trân trọng kính chào.</p>
        <p class="info-recieve__inf">Thế giới nước hoa Perfume T&T</p>
        <p class="info-recieve__inf">Điện thoại: <span>0916494960</span></p>
        <p class="info-recieve__inf">Địa chỉ: <span>1716 Huỳnh Tấn Phát, thị trấn Nhà Bè, huyện Nhà Bè, thành phố Hồ Chí Minh</span></p>
    </div>
</body>

</html>