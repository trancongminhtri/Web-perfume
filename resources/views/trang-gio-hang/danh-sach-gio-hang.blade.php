@if(Session::has('Cart') != null)
<!-- Tiêu đề -->
<div class="row_g no-gutters row_g-title hide-on-mobile">
    <div class="col_g l-4_g m-4_g c-4_g">
        <div class="perfume-cart__title perfume-cart__title-left">
            Sản phẩm
        </div>
    </div>

    <div class="col_g l-2_g m-2_g c-2_g">
        <div class="perfume-cart__title">
            Đơn giá
        </div>
    </div>

    <div class="col_g l-1_g m-1_g c-1_g">
        <div class="perfume-cart__title">
            Số lượng
        </div>
    </div>

    <div class="col_g l-2_g m-2_g c-2_g">
        <div class="perfume-cart__title">
            Khuyến mãi
        </div>
    </div>

    <div class="col_g l-2_g m-2_g c-2_g">
        <div class="perfume-cart__title">
            Thành tiền
        </div>
    </div>

    <div class="col_g l-1_g m-1_g c-1_g">
        <div class="perfume-cart__title">
            Xóa
        </div>
    </div>

</div>
@foreach(Session::get('Cart')->dsNuocHoa as $nuocHoa)
<!-- Nước hoa tablet & PC -->
<div class="row_g no-gutters row_content hide-on-mobile">
    <div class="col_g l-4_g m-4_g c-4_g">
        <div class="perfume-cart__product">
            <img class="product__img" src="../{{$nuocHoa['thongTinNuocHoa']->duong_dan}}" alt="">
            <div>
                <span class="product__name">
                    {{$nuocHoa['thongTinNuocHoa']->ten_nuoc_hoa}}
                </span>
                <span class="product__promotion-name">
                    {{$nuocHoa['thongTinNuocHoa']->ten_khuyen_mai}}
                </span>
            </div>
        </div>
    </div>

    <div class="col_g l-2_g m-2_g c-2_g">
        <div class="perfume-cart__content perfume-cart__center">
            <span class="perfume-cart__unit-sprice">{{number_format($nuocHoa['thongTinNuocHoa']->gia_tien)}}</span>
            <span>vnđ</span>
        </div>
    </div>

    <div class="col_g l-1_g m-1_g c_1_g">
        <div class="perfume-cart__content perfume-cart__quantity perfume-cart__center">
            <button class="quantity__minus" {{$nuocHoa['soLuong'] == 1 ? 'disabled' : ''}} data-id-quantity="{{$nuocHoa['thongTinNuocHoa']->id}}">-</button>
            <input readonly id="quantity__number_{{$nuocHoa['thongTinNuocHoa']->id}}" class="quantity_num" value="{{$nuocHoa['soLuong']}}">
            <button class="quantity__plus" data-id-quantity="{{$nuocHoa['thongTinNuocHoa']->id}}">+</button>
        </div>
    </div>

    <div class="col_g l-2_g m-2_g c-2_g">
        <div class="perfume-cart__content  perfume-cart__center">
            <span class="perfume-cart__promotion">{{number_format($nuocHoa['giaKhuyenMai'])}}</span>
            <span>vnđ</span>
        </div>
    </div>

    <div class="col_g l-2_g m-2_g c-2_g">
        <div class="perfume-cart__content perfume-cart__center">
            <span class="perfume-cart__into-money">{{number_format($nuocHoa['giaTien'])}}</span>
            <span>vnđ</span>
        </div>
    </div>

    <div class="col_g l-1_g m-1_g c-1_g">
        <div class="perfume-cart__content perfume-cart__trash perfume-cart__center">
            <a onclick="deleteItemListCart({{$nuocHoa['thongTinNuocHoa']->id}})"><i class="far fa-trash-alt"></i></a>
        </div>
    </div>
</div>

<!-- Nước hoa Mobile -->
<div class="row_g row_content hide-on-tablet hide-on-pc">
    <div class="col_g c-12_g">
        <div class="row_g row_content">
            <div class="col_g c-2_g">
                <div class="perfume-cart__product-img">
                    <!-- Nước hoa img -->
                    <img class="product__img product__img-cart" src="../{{$nuocHoa['thongTinNuocHoa']->duong_dan}}" alt="">
                </div>
            </div>
            <div class="col_g c-9_g" style="margin-left: -4px;">
                <div class="perfume-cart__product-content">
                    <!-- Nước hoa name -->
                    <div class="perfume-cart__product perfume-cart__product-cart" style="width:100%;">
                        <div>
                            <span class="product__name product__name-cart">
                                {{$nuocHoa['thongTinNuocHoa']->ten_nuoc_hoa}}
                            </span>
                        </div>
                    </div>
                    <!-- Giá tiên -->
                    <div class="perfume-cart__content perfume-cart__center">
                        <span class="perfume-cart__unit-sprice"><span class="unit-sprice-title">Giá: </span> {{number_format($nuocHoa['thongTinNuocHoa']->gia_tien)}}</span>
                        <span>vnđ</span>
                        <!-- Số lượng -->
                        <div class="perfume-cart__content perfume-cart__quantity perfume-cart__quantity-cart perfume-cart__center">
                            <button class="quantity__minus quantity__minus-cart" {{$nuocHoa['soLuong'] == 1 ? 'disabled' : ''}} data-id-quantity="{{$nuocHoa['thongTinNuocHoa']->id}}">-</button>
                            <input readonly id="quantity__number_{{$nuocHoa['thongTinNuocHoa']->id}}" class="quantity_num quantity_num-cart" value="{{$nuocHoa['soLuong']}}">
                            <button class="quantity__plus quantity__plus-cart" data-id-quantity="{{$nuocHoa['thongTinNuocHoa']->id}}">+</button>
                        </div>
                    </div>
                    <!-- Khuyến mãi -->
                    <div class="perfume-cart__content perfume-cart__center">
                        <span class="perfume-cart__promotion"><span class="unit-sprice-title">Khuyến mãi: </span>{{number_format($nuocHoa['giaKhuyenMai'])}}</span>
                        <span>vnđ</span>
                    </div>
                    <!-- Thành tiền -->
                    <div class="perfume-cart__content perfume-cart__center">
                        <span class="perfume-cart__into-money"><span class="unit-sprice-title">Thành tiền: </span>{{number_format($nuocHoa['giaTien'])}}</span>
                        <span>vnđ</span>
                    </div>
                </div>
            </div>
            <div class="col_g c-1_g"> 
                <!-- Xóa nước hoa -->
                <div class="perfume-cart__content perfume-cart__trash perfume-cart__center" style="margin-left: -6px;">
                        <a onclick="deleteItemListCart({{$nuocHoa['thongTinNuocHoa']->id}})"><i class="far fa-trash-alt"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
<!-- Button -->
<div class="row_g no-gutters">
    <div class="col_g l-12_g m-12_g c-12_g">
        <div class="cart-pay">
            <a href="{{route('nguoidung.trang-chu-nguoi-dung')}}" class="cart-back__btn">Trở lại</a>
            @if(!auth()->check())
            <a class="cart-pay__btn" onclick="formLogin()">Tiếp tục</a>
            @else
            <a href="{{route('trang-thanh-toan')}}" class="cart-pay__btn">Tiếp tục</a>
            @endif

        </div>
    </div>
</div>
@else
<!-- Giỏ hàng trống -->
<div class="perfume-cart__contents-none">
    <div class="row_g no-gutters">
        <div class="col_g l-12_g m-12_g c-12_g">
            <div class="perfume-cart__none">
                <img src="{{asset('assets/img/no_cart.png')}}" alt="" class="perfume-cart__none-img">
                <span>Chưa có sản phẩm</span>
                <a href="{{route('nguoidung.trang-chu-nguoi-dung')}}" class="perfume-cart__none-btn">Trở lại</a>
            </div>
        </div>
    </div>
</div>
@endif