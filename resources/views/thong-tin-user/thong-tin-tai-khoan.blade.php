@extends('layout-user')
@section('title')
@endsection
@section('content')
<!-- Start Container -->
<div class="content__account-info">
    <div class="grid_g wide_g2">

        <!-- Thông tin cá nhân -->
        <div class="row_g row_g-background row_g-hei">
            <div class="col_g c-12_g m-12_g l-12_g">
                <div class="add-form__header add-form__haeder-profile-info add-form__add-account--center">
                    <h3 class="add-form__haeding add-form__haeding-profile-info">Hồ Sơ Của Bạn</h3>
                </div>
            </div>
        </div>

        <div class="row_g row_g-background row_g-order">
            <div class="col_g l-9_g m-9_g c-12_g flex-ord2">
                <div class="add-form add-form__profile-info">
                    <div class="add-form__container add-form__container-profile-info">

                        <div class="add-form__form">

                            <div class="add-form__group">
                                <label for="">Email:</label>
                                <div class="add-form__item">
                                    <input readonly type="email" value="{{auth()->user()->email}}" class="add-form__input add-form__input-email">
                                </div>
                            </div>

                            <div class="add-form__group">
                                <label for="">Họ tên:</label>
                                <div class="add-form__item">
                                    <input readonly value="{{auth()->user()->ho_ten}}" type="text" class="add-form__input">
                                </div>
                            </div>

                            <div class="add-form__group">
                                <label for="">Số điện thoại:</label>
                                <div class="add-form__item">
                                    <input readonly value="{{auth()->user()->sdt}}" type="number" class="add-form__input add-form__input-number">
                                </div>
                            </div>

                            <div class="add-form__group add-form__group-textarea">
                                <label for="">Địa chỉ:</label>
                                <div class="add-form__item">
                                    <textarea readonly="readonly" class="add-form__textarea">{{auth()->user()->dia_chi}}</textarea>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>
            </div>

            <div class="col_g l-3_g m-3_g c-12_g flex-ord1">
                <div class="profile-avatar">
                    @if(auth()->user()->anh_dai_dien == NULL)
                    <img class="profile-avatar__img" src="{{asset('assets/img/avt_none.PNG')}}" alt="">
                    @else
                    <img class="profile-avatar__img" src="../{{auth()->user()->anh_dai_dien}}" alt="">
                    @endif
                    <span class="profile-avatar__note">Ảnh đại diện</span>
                </div>
            </div>

            <div class="col_g l-12_g m-12_g c-12_g flex-ord3">
                <!-- Trở lại -->
                <div class="add-form__controls add-form__controls-order-list">
                    <a href="{{route('nguoidung.trang-chu-nguoi-dung')}}" type="button" class="btn btn__list-order-back add-form__controls-back btn--normal">TRỞ LẠI</a>
                    <a href="{{route('trang-cap-nhat-ho-so')}}" type="button" class="btn add-form__controls-back btn--primary">CẬP NHẬT</a>
                </div>
            </div>
        </div>

        <div class="row_g row_g-background row_g-hei">
            <div class="col_g l-12_g m-12_g c-12_g">
                <!-- Danh sách đơn hàng -->
                <div class="list-order">

                    <div class="add-form__header add-form__haeder-list-order add-form__add-account--center">
                        <h3 class="add-form__haeding add-form__haeding-list-order">Danh sách đơn hàng</h3>
                    </div>
                    <!-- Danh sách đơn hàng trên PC and Tablet -->
                    <table class="table hide-on-mobile">
                        <thead>
                            <tr class="title__list-order">
                                <th scope="col ">STT</th>
                                <th scope="col">Mã đơn hàng</th>
                                <th scope="col">Sản phẩm</th>
                                <th scope="col">Thời gian</th>
                                <th scope="col">Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($arrDonHang as $stt => $donHang)
                            <tr class="content__list-order">
                                <td scope="row">{{$stt + 1}}</td>
                                <td>{{$donHang['id']}}</td>
                                <td>
                                    <div class="list-bought">
                                        <div class="bought-receive">
                                            <div class="bought-receive__name bought-receive__common">
                                                <span class="bought-receive__title">Người nhận:</span>
                                                <span class="bought-receive__content">{{$donHang['ten_khach_hang']}}</span>
                                            </div>

                                            <div class="bought-receive__numphone bought-receive__common">
                                                <span class="bought-receive__title">Điện thoại:</span>
                                                <span class="bought-receive__content">{{$donHang['sdt']}}</span>
                                            </div>

                                            <div class="bought-receive__address bought-receive__common">
                                                <span class="bought-receive__title">Địa chỉ:</span>
                                                <span class="bought-receive__content">{{$donHang['dia_diem']}}</span>
                                            </div>
                                        </div>
                                        @foreach($donHang['nuoc_hoa'] as $stt => $nuocHoa)
                                        <div class="perfume-bought">
                                            <div class="bought-left">
                                                <img src="{{$nuocHoa['duong_dan']}}" alt="" class="bought-left__img">
                                            </div>

                                            <div class="bought-right">
                                                <div class="info__up">
                                                    {{$nuocHoa['ten_nuoc_hoa']}}
                                                </div>

                                                <div class="info__down">
                                                    <div class="info-price">
                                                        <span class="info-price__cost">{{number_format($nuocHoa['gia_tien_goc'] - $nuocHoa['gia_tien_km'])}}</span>
                                                        <span>vnđ</span>
                                                    </div>

                                                    <div class="info-quatity">
                                                        <span readonly class="info-quatity__num"> <span>x</span>{{$nuocHoa['so_luong_san_pham']}}</span>
                                                    </div>

                                                    <div class="info-total">
                                                        <span class="info-total__title">=</span>
                                                        <span class="info-total__mon">{{number_format($nuocHoa['thanh_toan'])}}
                                                        </span>
                                                        <span>vnđ</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach

                                        <div class="bought-inf">
                                            <div class="bought-total">
                                                <span>Thành tiền:</span>
                                                <span class="bought-total__pay">{{number_format($donHang['tong_thanh_toan'])}}</span>
                                                <span class="bought-total__unit">vnđ</span>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($donHang['created_at'])->format('d-m-Y H:i:s')}}</td>
                                <td>{{$donHang['trang_thai']}}</td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>

                    <!-- Danh sách đơn hàng trên mobile -->
                    @foreach($arrDonHang as $stt => $donHang)
                    <div class="list-bought hide-on-pc hide-on-tablet">
                        <div class="bought-inf">
                            <div class="bought-code">
                                <span>Mã đơn:</span>
                                <span class="bought-code__order">{{$donHang['id']}}</span>
                            </div>
                            <div class="bought-total">
                                <span>Thành tiền:</span>
                                <span class="bought-total__pay">{{number_format($donHang['tong_thanh_toan'])}}</span>
                                <span class="bought-total__unit">vnđ</span>
                            </div>
                        </div>

                        <div class="bought-inf-down">
                            <div class="bought-status">
                                <span>Trạng thái:</span>
                                <span class="bought-status__sta">{{$donHang['trang_thai']}}</span>
                            </div>
                            <div class="bought-date">
                                <span>Ngày:</span>
                                <input readonly type="text" value="{{$donHang['created_at']}}">
                            </div>
                        </div>
                        @foreach($donHang['nuoc_hoa'] as $stt => $nuocHoa)
                        <div class="perfume-bought">
                            <div class="bought-left">
                                <img src="{{$nuocHoa['duong_dan']}}" alt="" class="bought-left__img">
                            </div>

                            <div class="bought-right">
                                <div class="info__up">
                                    {{$nuocHoa['ten_nuoc_hoa']}}
                                </div>

                                <div class="info__down">
                                    <div class="info-price">
                                        <!-- <span class="info-price__title">Giá bán: </span> -->
                                        <span class="info-price__cost">{{number_format($nuocHoa['gia_tien_goc'] - $nuocHoa['gia_tien_km'])}}</span>
                                        <span>vnđ</span>

                                    </div>

                                    <div class="info-quatity">
                                        <!-- <span class="info-quantity__title">Số lượng: </span> -->
                                        <span readonly class="info-quatity__num"> <span>x</span>{{$nuocHoa['so_luong_san_pham']}}</span>

                                    </div>

                                    <div class="info-total">
                                        <span class="info-total__title">Tổng:</span>
                                        <span class="info-total__mon">{{number_format($nuocHoa['thanh_toan'])}}
                                        </span>
                                        <span>vnđ</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                        <div class="bought-receive">
                            <div class="bought-receive__name bought-receive__common">
                                <span class="bought-receive__title">Người nhận:</span>
                                <span class="bought-receive__content">{{$donHang['ten_khach_hang']}}</span>
                            </div>

                            <div class="bought-receive__numphone bought-receive__common">
                                <span class="bought-receive__title">Điện thoại:</span>
                                <span class="bought-receive__content">{{$donHang['sdt']}}</span>
                            </div>

                            <div class="bought-receive__address bought-receive__common">
                                <span class="bought-receive__title">Địa chỉ:</span>
                                <span class="bought-receive__content">{{$donHang['dia_diem']}}</span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Container -->
@endsection
@section('page-js')
@endsection