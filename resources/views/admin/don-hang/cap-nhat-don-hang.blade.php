@extends('admin.layout-admin')
@section('title')
<link rel="stylesheet" href="{{asset('assets/css/main.css')}}">
@endsection
@section('content')
<div class="content-admin">
    <div class="grid_g wide_g2">
        <div class="row_g">
            <div class="perfume-cart">

                <div class="status-bill__name">Cập Nhật Trạng Thái</div>
                <form action="{{route('quanly.cap-nhat-don-hang', $timDonHang['id'])}}" id="cap-nhat-don-hang" method="POST">
                    @csrf
                    <div class="status-info">
                        <div class="code-bill">
                            <span class="code-bill__title">Mã đơn:</span>
                            <span class="code-bill__content">{{$timDonHang['id']}}</span>
                        </div>
                        <div class="datetime-bill">
                            <span class="datetime-bill__title">Ngày đặt:</span>
                            <input readonly="readonly" type="datetime" class="datetime-bill__content" value="{{ \Carbon\Carbon::parse($timDonHang['created_at'])->format('d-m-Y H:i:s')}}">
                        </div>

                        <div class="update-status">
                            <span class="update-status__title">Chọn trạng thái:</span>
                            <select class="update-status__content" name="trang_thai_id">
                                @foreach($dsTrangThai as $trangThai)
                                <option value="{{$trangThai['id']}}" {{$timDonHang->trang_thai_id == $trangThai['id'] ? 'selected' : ''}}>{{$trangThai['trang_thai']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Sản phẩm của thanh toán trên PC và Tablet -->
                    <div class="status-bill__contents">
                        <!-- Tiêu đề  -->
                        <div class="row_g no-gutters row_g-title__bill ">

                            <div class="col_g l-5_g m-50_g">
                                <div class="status-bill__title">
                                    Sản phẩm
                                </div>
                            </div>

                            <div class="col_g l-2_g m-12-2_g">
                                <div class="status-bill__title">
                                    Đơn giá
                                </div>
                            </div>

                            <div class="col_g l-1_g m-12-2_g">
                                <div class="status-bill__title">
                                    Số lượng
                                </div>
                            </div>

                            <div class="col_g l-2_g m-12-2_g">
                                <div class="status-bill__title">
                                    Khuyến mãi
                                </div>
                            </div>

                            <div class="col_g l-2_g m-12-2_g">
                                <div class="status-bill__title">
                                    Thành tiền
                                </div>
                            </div>

                        </div>

                        <!-- Nội dung  -->
                        @foreach($dsChiTiet as $chiTiet)
                        <div class="row_g no-gutters row-content__bill">
                            <div class="col_g l-5_g m-50_g">
                                <div class="perfume-cart__product ">
                                    <img class="product__img" src="../{{$chiTiet['duong_dan']}}" alt="">
                                    <div>
                                        <span class="product__name">
                                            {{$chiTiet['ten_nuoc_hoa']}}
                                        </span>
                                        <!-- <span class="product__promotion-name">
                                                Sale 7/7
                                            </span> -->
                                    </div>

                                </div>
                            </div>

                            <div class="col_g l-2_g m-12-2_g">
                                <div class="perfume-cart__content perfume-cart__unit-sprice perfume-cart__center unit-sprice__order">
                                    {{number_format($chiTiet['gia_tien_goc'])}}vnđ
                                </div>
                            </div>

                            <div class="col_g l-1_g m-12-2_g">
                                <div class="perfume-cart__content perfume-cart__quantity perfume-cart__center unit-sprice__order">
                                    <span class="quantity_num">{{number_format($chiTiet['so_luong_san_pham'])}}</span>
                                </div>
                            </div>

                            <div class="col_g l-2_g m-12-2_g">
                                <div class="perfume-cart__content perfume-cart__promotion perfume-cart__center unit-sprice__order">
                                    {{number_format($chiTiet['gia_tien_km'])}}vnđ
                                </div>
                            </div>

                            <div class="col_g l-2_g m-12-2_g">
                                <div class="perfume-cart__content perfume-cart__into-money perfume-cart__center unit-sprice__order">
                                    {{number_format($chiTiet['thanh_toan'])}}vnđ
                                </div>
                            </div>

                        </div>
                        @endforeach

                        <!-- Thông tin nhận hàng  -->
                        <div class="row_g no-gutters row-cart__pay">

                            <div class="col_g l-9_g m-9_g c-12_g">
                                <div class="address-receive-info">

                                    <div class="address-receive__heading">Thông tin người nhận:</div>

                                    <div class="address-receive address-receive__name address-receive__bill">
                                        <div class="address-receive__title address-receive__title-status unit-sprice__order">Email:</div>
                                        <div class="address-receive__parsl">
                                            <input onfocus="this.select()" readonly="readonly" type="text" id="address-receive__fullname-id" class="address-receive__content address-receive__fullname unit-sprice__order" value="{{$timDonHang['email']}}">
                                        </div>
                                    </div>

                                    <div class="address-receive address-receive__name address-receive__bill">
                                        <div class="address-receive__title address-receive__title-status unit-sprice__order">Họ Tên:</div>
                                        <div class="address-receive__parsl">
                                            <input onfocus="this.select()" readonly="readonly" type="text" id="address-receive__fullname-id" class="address-receive__content address-receive__fullname unit-sprice__order" value="{{$timDonHang['ten_khach_hang']}}">
                                        </div>
                                    </div>

                                    <div class="address-receive address-receive__phone address-receive__bill">
                                        <div class="address-receive__title address-receive__title-status unit-sprice__order">Điện thoại:</div>
                                        <div class="address-receive__parsl">
                                            <input onfocus="this.select()" readonly="readonly" type="number" id="address-receive__numphone-id" class="address-receive__content address-receive__numphone unit-sprice__order" value="{{$timDonHang['sdt']}}">
                                        </div>
                                    </div>

                                    <div class="address-receive address-receive__map address-receive__bill">
                                        <div class="address-receive__title address-receive__title-status unit-sprice__order">Địa chỉ:</div>
                                        <div class="address-receive__parsl">
                                            <input onfocus="this.select()" readonly="readonly" id="address-receive__addmap-id" class="address-receive__content address-receive__addmap unit-sprice__order" value="{{$timDonHang['dia_diem']}}">

                                            <!-- <textarea onfocus="this.select()" readonly="readonly" 
                                                                id="address-receive__addmap-id" class="address-receive__content address-receive__addmap address-receive__content-textarea" 
                                                                required data-parsley-required-message="Vui lòng nhập địa chỉ!">1716/46/16 Huỳnh Tấn Phát, Thị Trấn Nhà Bè, Huyện Nhà Bè, TP. Hồ Chí Minh
                                                                </textarea> -->
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Thanh toán -->
                            <div class="col l-3_g m-3_g c-12_g">
                                <div class="row_g no-gutters row-cart__pay">
                                    <div class="col_g l-6_g ">
                                        <div class="status-bill__title status-bill__title-left cart__total-money ">Tổng tiền:</div>
                                    </div>

                                    <div class="col_g l-6_g">
                                        <div class="perfume-cart__content cart__total-money unit-sprice__order">{{number_format($timDonHang['tong_tien'])}}vnđ</div>
                                    </div>

                                </div>

                                <div class="row_g no-gutters row-cart__pay">
                                    <div class="col_g l-6_g">
                                        <div class="status-bill__title status-bill__title-left cart__total-promotion ">Tổng khuyến mãi:</div>
                                    </div>

                                    <div class="col_g l-6_g">
                                        <div class="perfume-cart__content cart__total-promotion unit-sprice__order">{{number_format($timDonHang['tong_tien_giam'])}}vnđ</div>
                                    </div>

                                </div>

                                <div class="row_g no-gutters row-cart__pay">
                                    <div class="col_g l-6_g">
                                        <div class="status-bill__title status-bill__title-left cart__total-pay">Tổng thanh toán:</div>
                                    </div>

                                    <div class="col_g l-6_g">
                                        <div class="perfume-cart__content cart__total-pay unit-sprice__order">{{number_format($timDonHang['tong_thanh_toan'])}}vnđ</div>
                                    </div>

                                </div>
                            </div>

                        </div>

                        <!-- Button -->
                        <div class="row_g no-gutters">
                            <div class="col_g l-12_g m-12_g c-12_g">
                                <div class="cart-pay">
                                    <a href="{{route('quanly.ql-don-hang')}}" class="cart-back__btn">HỦY</a>
                                    <button class="cart-pay__btn">CẬP NHẬT</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
@section('page-js')
<script>
    $('#cap-nhat-don-hang').submit(function(event) {
        event.preventDefault();
        var form = $(this);
        var url = form.attr('action');
        Swal.fire({
            title: 'Bạn có chắc muốn cập nhật đơn hàng ?',
            icon: 'warning',
            showCancelButton: true,
            cancelButtonColor: '#d33',
            confirmButtonColor: '#3085d6',
            cancelButtonText: 'Hủy',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: form.serialize(),
                    success: function(data) {
                        if (data.status == 'success') {
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: data.message,
                                showConfirmButton: false,
                                timer: 1500
                            })
                            window.setTimeout(function() {
                                window.location.replace("{{route('quanly.ql-don-hang')}}");
                            }, 1500);
                        } else {
                            Swal.fire({
                                position: 'center',
                                icon: 'error',
                                title: data.message,
                                showConfirmButton: false,
                                timer: 1500
                            })
                        }
                    },
                });
            }
        })
    });
</script>
@endsection