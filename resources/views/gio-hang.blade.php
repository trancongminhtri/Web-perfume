@if(Session::has('Cart') != null)
<i class="header__cart-icon fas fa-shopping-cart"></i>
<span id="header__cart-notice" class="header__cart-notice">{{Session::get('Cart')->tongSoLuong}}</span>
<!-- No cart: header__cart-list--no-cart -->
<div class="header__cart-list ">
    <h4 class="header__cart-heading">Sản phẩm đã thêm</h4>
    <ul class="header__cart-list-item">
        @foreach(Session::get('Cart')->dsNuocHoa as $nuocHoa)
        <li class="header__cart-item">
            <img src="../{{$nuocHoa['thongTinNuocHoa']->duong_dan}}" alt="" class="header__cart-item-img">

            <div class="header__cart-item-info">
                <div class="header__cart-item-head">
                    <h5 class="header__cart-item-name">{{$nuocHoa['thongTinNuocHoa']->ten_nuoc_hoa}}</h5>
                    <div class="header__cart-item-price-wrap">
                        <span class="header__cart-item-price">{{number_format($nuocHoa['giaTien'])}}đ</span>
                        <span class="header__cart-item-multiply">x</span>
                        <span class="header__cart-item-quantity">{{$nuocHoa['soLuong']}}</span>
                    </div>
                </div>
                <div class="header__cart-item-body">
                    <span class="header__cart-item-description">
                        Phân loại: {{$nuocHoa['thongTinNuocHoa']->ten_dung_tich}}
                    </span>
                    <span class="header__cart-item-remove" data-id-cart="{{$nuocHoa['thongTinNuocHoa']->id}}">Xóa</span>
                </div>
            </div>
        </li>
        @endforeach
    </ul>
    <a href="{{route('khachhang.trang-gio-hang')}}" class="header__cart-view btn btn--primary">Xem giỏ hàng</a>
    <a href="{{route('nguoidung.trang-chu-nguoi-dung')}}" class="header__cart-view btn btn--primary">Trang chủ</a>
    <input hidden type="number" id="total-quanty-cart" value="{{Session::get('Cart')->tongSoLuong}}">
</div>
@else
    <i class="header__cart-icon fas fa-shopping-cart"></i>
    <span class="header__cart-notice">0</span>
@endif