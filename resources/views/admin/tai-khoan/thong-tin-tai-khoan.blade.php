@extends('admin.layout-admin')
@section('title')
@endsection
@section('content')
<div class="content-admin">
    <div class="grid_g">
        <div class="add-form__header add-form__haeder-profile-info add-form__add-account--center">
            <h3 class="add-form__haeding add-form__haeding-profile-info">Thông tin cá nhân</h3>
        </div>

        <!-- Thông tin cá nhân -->
        <div class="row_g">

            <!-- Cá nhân -->
            <div class="col_g l-7_g m-12_g c-12_g flex__custom-profile">
                <div class="add-form add-form__profile-info">
                    <div class="add-form__container add-form__container-profile-info">

                        <div class="add-form__form">

                            <div class="add-form__group">
                                <label for="">Email:</label>
                                <div class="add-form__item">
                                    <input readonly type="email" value="{{$item_user['email']}}" class="add-form__input add-form__input-email">
                                </div>
                            </div>

                            <div class="add-form__group">
                                <label for="">Họ tên:</label>
                                <div class="add-form__item">
                                    <input readonly value="{{$item_user['ho_ten']}}" type="text" class="add-form__input">
                                </div>
                            </div>

                            <div class="add-form__group">
                                <label for="">Số điện thoại:</label>
                                <div class="add-form__item">
                                    <input readonly value="{{$item_user['sdt']}}" type="number" class="add-form__input add-form__input-number">
                                </div>
                            </div>

                            <div class="add-form__group add-form__group-textarea">
                                <label for="">Địa chỉ:</label>
                                <div class="add-form__item">
                                    <textarea readonly type="text" class="add-form__input add-form__textarea add-form__textarea-address">{{$item_user['dia_chi']}}</textarea>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <!-- Ảnh đại diện -->
            <div class="col_g l-5_g m-12_g c-12_g flex__custom-avt">
                <div class="profile-avatar">
                    <img class="profile-avatar__img" alt="" 
                        @if(isset($item_user->anh_dai_dien))
                            src="../{{$item_user->anh_dai_dien}}"
                        @else
                            src="{{asset('assets/img/avt_none.PNG')}}"
                        @endif;>
                    <span class="profile-avatar__note">Ảnh đại diện</span>

                </div>
            </div>

            <!-- Danh sách đơn hàng -->
            <div class="col_g l-12_g m-12_g c-12_g flex__custom-list-order">
                @if(count($dsDonHang) != 0)
                    <div class="list-order">

                        <div class="add-form__header add-form__haeder-list-order add-form__add-account--center">
                            <h3 class="add-form__haeding add-form__haeding-list-order">Danh sách đơn hàng</h3>
                        </div>
                        <!-- Table list account -->
                        <table class="table ">
                            <thead>
                                <tr class="title__list-order">
                                    <th scope="col ">STT</th>
                                    <th scope="col">Mã đơn hàng</th>
                                    <th scope="col">Trạng thái</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($dsDonHang as $stt => $donHang)
                                    <tr class="content__list-order">
                                        <td scope="row">{{$stt + 1}}</td>
                                        <td>{{$donHang['id']}}</td>
                                        <td>{{$donHang['trang_thai']}}</td>
                                        <td>
                                            <a href="{{route('quanly.chi-tiet-don-hang' , $donHang['id'])}}"><i class="far fa-eye icon__view-detail"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                    @endif
            </div>

        </div>

        <!-- Trở lại -->
        <div class="row_g">
            <div class="col_g l-12_g m-12_g c-12_g">
                <div class="add-form__controls add-form__controls-order-list">
                    <a href="{{route('quanly.ql-tai-khoan')}}" type="button" class="btn btn__list-order-back add-form__controls-back btn--normal">TRỞ LẠI</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('page-js')
@endsection