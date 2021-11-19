@extends('layout-user')
@section('title')
@endsection
@section('content')
<div class="loader"></div>
<!-- Start Container -->
<div class="app-container__cart">
    <div class="grid_g wide_g2">
        <div class="row_g">
            <div class="perfume-cart">

                <div class="perfume-cart__name">Xác nhận đơn hàng</div>
                @if(Session::has('Cart') != null)
                    <!-- Sản phẩm của thanh toán trên PC và Tablet -->
                    <div class="perfume-cart__contents ">
                        <!-- Tiêu đề  -->
                        <div class="row_g no-gutters row_g-title hide-on-mobile">
                            <div class="col_g l-5_g m-5_g">
                                <div class="perfume-cart__title">
                                    Sản phẩm
                                </div>
                            </div>
                            <div class="col_g l-2_g m-2_g">
                                <div class="perfume-cart__title">
                                    Đơn giá
                                </div>
                            </div>
                            <div class="col_g l-1_g m-1_g">
                                <div class="perfume-cart__title">
                                    Số lượng
                                </div>
                            </div>
                            <div class="col_g l-2_g m-2_g">
                                <div class="perfume-cart__title">
                                    Khuyến mãi
                                </div>
                            </div>
                            <div class="col_g l-2_g m-2_g">
                                <div class="perfume-cart__title">
                                    Thành tiền
                                </div>
                            </div>
                        </div>

                        <!-- Nội dung  -->
                        <div class="row_g no-gutters row_content hide-on-mobile">
                            @foreach(Session::get('Cart')->dsNuocHoa as $nuocHoa)
                            <input hidden type="text" value="{{$nuocHoa['thongTinNuocHoa']->id}}" class="perfume-list-pay">
                            <div class="col_g l-5_g m-5_g">
                                <div class="perfume-cart__product ">
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

                            <div class="col_g l-2_g m-2_g">
                                <div class="perfume-cart__content perfume-cart__unit-sprice perfume-cart__center">
                                    <span class="original-price">{{number_format($nuocHoa['thongTinNuocHoa']->gia_tien)}}</span>vnđ
                                </div>
                            </div>

                            <div class="col_g l-1_g m-1_g">
                                <div class="perfume-cart__content perfume-cart__quantity perfume-cart__center">
                                    <span class="quantity_num amount-products">{{$nuocHoa['soLuong']}}</span>
                                </div>
                            </div>

                            <div class="col_g l-2_g m-2_g">
                                <div class="perfume-cart__content perfume-cart__promotion perfume-cart__center">
                                    <span class="promotional-price">{{number_format($nuocHoa['giaKhuyenMai'])}}</span>vnđ
                                </div>
                            </div>

                            <div class="col_g l-2_g m-2_g">
                                <div class="perfume-cart__content perfume-cart__into-money perfume-cart__center">
                                    <span class="into-money">{{number_format($nuocHoa['giaTien'])}}</span>vnđ
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <!-- Sản phẩm thanh toán trên Mobile -->
                        <div class="row_g hide-on-tablet hide-on-pc">
                            @foreach(Session::get('Cart')->dsNuocHoa as $nuocHoa)
                            <div class="col_g col_g-mar">
                                <div class=" perfume-cart__product">
                                    <img class="product__img" src="../{{$nuocHoa['thongTinNuocHoa']->duong_dan}}" alt="">
                                    <div>
                                        <span class="product__name">
                                            {{$nuocHoa['thongTinNuocHoa']->ten_nuoc_hoa}}
                                        </span>

                                        <div class="perfume-cart__content perfume-cart__center ">
                                            <span class="perfume-cart__title-num">Giá:</span>
                                            <span class="perfume-cart__into-money">{{number_format($nuocHoa['giaTien'])}}</span>
                                            <span>vnđ</span>
                                        </div>

                                        <div class="perfume-cart__content perfume-cart__quantity perfume-cart__center">
                                            <div class="perfume-cart__btn">
                                                <span class="perfume-cart__title-num">Số lượng:</span>
                                                <input readonly class="quantity_num quantity_num-def" value="{{$nuocHoa['soLuong']}}">
                                            </div>
                                        </div>

                                    </div>

                                </div>

                            </div>
                            @endforeach
                        </div>

                        <!-- Thông tin nhận hàng  -->
                        <div class="row_g no-gutters row-cart__pay">

                            <div class="col_g l-9_g m-9_g c-12_g">
                                <form data-parsley-validate id="thong-tin-nhan-hang">
                                    <div class="address-receive-info">
                                        <div class="address-receive__heading">Thông tin nhận hàng:</div>
                                        <div class="address-receive address-receive__name">
                                            <div class="address-receive__title address-receive__title-name">Họ Tên:</div>
                                            <div class="address-receive__parsl">
                                                <input onfocus="this.select()" readonly="readonly" type="text" id="address-receive__fullname-id" class="address-receive__content address-receive__fullname" value="{{auth()->user()->ho_ten}}" required data-parsley-required-message="Vui lòng nhập tên!">
                                            </div>
                                        </div>

                                        <div class="address-receive address-receive__phone">
                                            <div class="address-receive__title address-receive__title-numphone">Điện thoại:</div>
                                            <div class="address-receive__parsl">
                                                <input onfocus="this.select()" readonly="readonly" type="number" id="address-receive__numphone-id" class="address-receive__content address-receive__numphone" value="{{auth()->user()->sdt}}" required data-parsley-required-message="Vui lòng nhập số điện thoại!">
                                                <!-- data-parsley-length="[10, 10]" data-parsley-length-message="Số điện thoại không đúng!"> -->
                                            </div>
                                        </div>

                                        <div class="address-receive address-receive__map">
                                            <div class="address-receive__title address-receive__title-address">Địa chỉ:</div>
                                            <div class="address-receive__parsl">
                                                <textarea onfocus="this.select()" readonly="readonly" id="address-receive__addmap-id" class="address-receive__content address-receive__addmap address-receive__addmap-textarea" required data-parsley-required-message="Vui lòng nhập địa chỉ!">{{auth()->user()->dia_chi}}</textarea>
                                            </div>
                                        </div>

                                        <div class="address-receive__change">
                                            <a id="change__btn-info-id" class="change__btn-info" onclick="changeInfoUserReceive()">Thay đổi</a>
                                            <button type="button" id="btn__backsave-id" class="change__btn-info btn__savechange btn__backsave" onclick="backSave()">Hủy</button>
                                            <button id="btn__savechange-id" class="change__btn-info btn__savechange" onclick="saveChangeInfo()">Lưu</button>
                                        </div>
                                    </div>

                                </form>
                            </div>
                            <!-- Thanh toán -->
                            <div class="col l-3_g m-3_g c-12_g">
                                <div class="row_g no-gutters row-cart__pay">
                                    <div class="col_g l-6_g ">
                                        <div class="perfume-cart__title perfume-cart__title-left cart__total-money" style="text-align: left;">
                                            Tổng tiền: 
                                        </div>
                                    </div>
                                    <div class="col_g l-6_g">
                                        <div class="perfume-cart__content cart__total-money" style="margin-left: 2px;" style="text-align: left;">
                                            <span id="total-money">{{number_format(Session::get('Cart')->tongTienChinh)}}</span>vnđ
                                        </div>
                                    </div>

                                </div>

                                <div class="row_g no-gutters row-cart__pay">
                                    <div class="col_g l-6_g">
                                        <div class="perfume-cart__title perfume-cart__title-left cart__total-promotion" style="text-align: left;">
                                            Tổng khuyến mãi: </div>
                                    </div>
                                    <div class="col_g l-6_g">
                                        <div class="perfume-cart__content cart__total-promotion" style="margin-left: 2px;">
                                            <span id="total-promotion">{{number_format(Session::get('Cart')->tongKhuyenMai)}}</span>vnđ
                                        </div>
                                    </div>
                                </div>

                                <div class="row_g no-gutters row-cart__pay">
                                    <div class="col_g l-6_g">
                                        <div class="perfume-cart__title perfume-cart__title-left cart__total-ship" style="text-align: left;">
                                            Tổng số lượng: </div>
                                    </div>
                                    <div class="col_g l-6_g">
                                        <div class="perfume-cart__content cart__total-ship" id="total-quality"  style="margin-left: 2px;">{{Session::get('Cart')->tongSoLuong}}</div>
                                    </div>
                                </div>

                                <div class="row_g no-gutters row-cart__pay">
                                    <div class="col_g l-6_g">
                                        <div class="perfume-cart__title perfume-cart__title-left cart__total-pay" style="text-align: left;">
                                            Tổng thanh toán: 
                                        </div>
                                    </div>
                                    <div class="col_g l-6_g">
                                        <div class="perfume-cart__content cart__total-pay" style="margin-left: 2px;">
                                            <span id="total-pay">{{number_format(Session::get('Cart')->tongTien)}}</span>vnđ
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- Button -->
                        <div class="row_g no-gutters">
                            <div class="col_g l-12_g m-12_g c-12_g">
                                <div class="cart-pay">
                                    <a href="{{route('khachhang.trang-gio-hang')}}" class="cart-back__btn">Trở lại</a>
                                    <button id="id-cart-pay" class="cart-pay__btn">
                                        <span class="cart-pay__btn-text">Xác nhận</span>
                                    </button>
                                </div>
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
            </div>
        </div>
    </div>
</div>
<!-- End Container -->
@endsection
@section('page-js')
<script>
    $(document).ready(function() {
        $('.header__cart-item-remove').css('display', 'none');
    });
</script>

<script>
    let inputChangeFullName = document.getElementById("address-receive__fullname-id");
    let inputChangeAddress = document.getElementById('address-receive__addmap-id');
    let inputChangeNumPhone = document.getElementById("address-receive__numphone-id");

    let btnChangeInfo = document.getElementById("change__btn-info-id");
    let btnSaveChangeInfo = document.getElementById("btn__savechange-id");
    let btnBackChange = document.getElementById("btn__backsave-id");

    inputChangeFullName.focus(function() {
        $(this).select();
    })

    // Hàm Thay đổi thông tin
    function changeInfoUserReceive() {
        // Xóa thuộc tính readonly, xóa class readonly, thêm css cho ô ipnut
        inputChangeFullName.removeAttribute("readonly");
        inputChangeFullName.classList.remove("readonly");
        inputChangeFullName.style.border = "0.5px solid";

        inputChangeNumPhone.removeAttribute("readonly");
        inputChangeNumPhone.classList.remove("readonly");
        inputChangeNumPhone.style.border = "0.5px solid";


        inputChangeAddress.removeAttribute("readonly");
        inputChangeAddress.classList.remove("readonly");
        inputChangeAddress.style.border = "0.5px solid";

        // Ẩn hiện nút thay đổi, lưu, hủy
        btnSaveChangeInfo.style.display = "block";
        btnBackChange.style.display = "block";
        btnChangeInfo.style.display = "none";
    }

    // Hàm lưu thông tin
    function saveChangeInfo() {
        // Lấy dữ liệu ô input
        let valFullName = inputChangeFullName.value;
        let valNumPhone = inputChangeNumPhone.value;
        let valAddress = inputChangeAddress.value;


        if (valFullName == "" || valNumPhone == "" || valAddress == "") {
            inputChangeFullName.removeAttribute("readonly");
            inputChangeFullName.classList.remove("readonly");
            inputChangeFullName.style.border = "0.5px solid";

            inputChangeNumPhone.removeAttribute("readonly");
            inputChangeNumPhone.classList.remove("readonly");
            inputChangeNumPhone.style.border = "0.5px solid";


            inputChangeAddress.removeAttribute("readonly");
            inputChangeAddress.classList.remove("readonly");
            inputChangeAddress.style.border = "0.5px solid";

            // Ẩn hiện nút thay đổi, lưu, hủy
            btnSaveChangeInfo.style.display = "block";
            btnBackChange.style.display = "block";
            btnChangeInfo.style.display = "none";
        } else {
            // Thêm thuộc tính readonly, sửa css cho ô ipnut
            inputChangeFullName.setAttribute("readonly", "readonly");
            inputChangeFullName.style.border = "none";
            inputChangeFullName.style.color = "#000";
            inputChangeFullName.style.background = "transparent";

            inputChangeNumPhone.setAttribute("readonly", "readonly");
            inputChangeNumPhone.style.border = "none";
            inputChangeNumPhone.style.color = "#000";
            inputChangeNumPhone.style.background = "transparent";

            inputChangeAddress.setAttribute("readonly", "readonly");
            inputChangeAddress.style.border = "none";
            inputChangeAddress.style.color = "#000";
            inputChangeAddress.style.background = "transparent";

            btnSaveChangeInfo.style.display = "none";
            btnBackChange.style.display = "none";
            btnChangeInfo.style.display = "block";
        }
    }

    // Hàm hủy lưu thông tin
    function backSave() {

        // Thêm thuộc tính readonly, sửa css cho ô ipnut
        inputChangeFullName.setAttribute("readonly", "readonly");
        inputChangeFullName.style.border = "none";
        inputChangeFullName.style.color = "#000";
        inputChangeFullName.style.background = "transparent";

        inputChangeNumPhone.setAttribute("readonly", "readonly");
        inputChangeNumPhone.style.border = "none";
        inputChangeNumPhone.style.color = "#000";
        inputChangeNumPhone.style.background = "transparent";

        inputChangeAddress.setAttribute("readonly", "readonly");
        inputChangeAddress.style.border = "none";
        inputChangeAddress.style.color = "#000";
        inputChangeAddress.style.background = "transparent";

        // Lấy dữ liệu mặc định
        inputChangeFullName.value = "{{auth()->user()->ho_ten}}";
        inputChangeNumPhone.value = "{{auth()->user()->sdt}}";
        inputChangeAddress.value = "{{auth()->user()->dia_chi}}";


        // Ẩn hiện nút thay đổi, lưu, hủy
        btnSaveChangeInfo.style.display = "none";
        btnBackChange.style.display = "none";
        btnChangeInfo.style.display = "block";
    }
</script>

<!-- Giữ trang thanh toán khi submit thông tin người nhận -->
<script>
    $('#thong-tin-nhan-hang').submit(function(event) {
        event.preventDefault();
    });
</script>

<!-- Thanh toán danh sách sản phẩm trong trang thanh toán -->
<script>
    function payProducts() {
        event.preventDefault();

        var formData = new FormData();
        formData.append('tong_tien', $('#total-money').text().replace(/\,/g, ""));
        formData.append('tong_tien_giam', $('#total-promotion').text().replace(/\,/g, ""));
        formData.append('tong_so_luong', $('#total-quality').text());
        formData.append('tong_thanh_toan', $('#total-pay').text().replace(/\,/g, ""));
        formData.append('ten_khach_hang', $('#address-receive__fullname-id').val());
        formData.append('sdt', $('#address-receive__numphone-id').val());
        formData.append('dia_diem', $('#address-receive__addmap-id').val());
       
        $.ajax({
            type: 'POST',
            url: "{{route('thanh-toan-don-hang')}}",
            data: formData,
            // async: false,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function() {
                showLoadingBtn();
            },
            success: function(data) {
                hideLoadingBtn();
                if (data.status == 'success') {
                    Swal.fire({
                        width: 500,
                        position: 'center',
                        icon: 'success',
                        title: data.message,
                        showConfirmButton: false,
                        timer: 2500
                    })
                    window.setTimeout(function() {
                        window.location.replace("{{route('nguoidung.trang-chu-nguoi-dung')}}");
                    }, 2500);
                } else {
                    hideLoadingBtn();
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: data.message,
                        showConfirmButton: false,
                        timer: 2500
                    })
                }
            }
        });

    }
    $(function() {
        $(document).on('click', '#id-cart-pay', payProducts);
    });
</script>

<!-- Loading xút xác nhận -->
<script>
    function showLoadingBtn() {
        $('.cart-pay__btn').addClass('cart-pay__btn-loading');
        $('.cart-pay__btn').attr('disabled', true);
        $('.cart-pay__btn').css('opacity', '0.5');
    }

    function hideLoadingBtn() {
        $('.cart-pay__btn').removeClass('cart-pay__btn-loading');
        $('.cart-pay__btn').delay(800).attr('disabled', false);
        $('.cart-pay__btn').delay(800).css('opacity', '1');
    }
</script>

@endsection