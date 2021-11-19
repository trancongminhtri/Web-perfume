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
                    <h3 class="add-form__haeding add-form__haeding-profile-info">Cập Nhật Hồ Sơ Của Bạn</h3>
                </div>
            </div>
        </div>
        <form action="{{route('cap-nhat-ho-so')}}" method="POST" id="cap-nhat-thong-tin" data-parsley-validate>
            <div class="row_g row_g-background row_g-order">
                <div class="col_g l-9_g m-9_g c-12_g flex-ord2">
                    <div class="add-form add-form__profile-info">
                        <div class="add-form__container add-form__container-profile-info">

                            <div class="add-form__form">

                                <div class="add-form__group">
                                    <label for="">Email:</label>
                                    <div class="add-form__item">
                                        <input readonly disabled="disabled" type="email" value="{{auth()->user()->email}}" class="add-form__input add-form__input-email">
                                    </div>
                                </div>

                                <div class="add-form__group">
                                    <label for="">Họ tên:</label>
                                    <div class="add-form__item">
                                        <input value="{{auth()->user()->ho_ten}}" id="ho_ten" name="ho_ten" type="text" class="add-form__input" required data-parsley-required-message="Vui lòng nhập họ tên!" minlength="6" data-parsley-minlength-message="Họ tên ít nhất 6 ký tự!">
                                    </div>
                                </div>

                                <div class="add-form__group">
                                    <label for="">Số điện thoại:</label>
                                    <div class="add-form__item">
                                        <input value="{{auth()->user()->sdt}}" id="sdt" name="sdt" type="number" class="add-form__input add-form__input-number edit-form__input-number" required data-parsley-required-message="Vui lòng nhập số điện thoại!">
                                    </div>
                                </div>

                                <div class="add-form__group add-form__group-textarea">
                                    <label for="">Địa chỉ:</label>
                                    <div class="add-form__item">
                                        <textarea class="add-form__textarea" id="dia_chi" name="dia_chi" required data-parsley-required-message="Vui lòng nhập địa chỉ!">{{auth()->user()->dia_chi}}</textarea>
                                    </div>
                                </div>

                                <div class="add-form__group change-password__title">
                                    <h3>Đổi mật khẩu</h3>
                                </div>

                                <div class="add-form__group">
                                    <label class="add-form__name add-form__name-pass" for="">Mật khẩu mới:</label>
                                    <div class="add-form__item auth-form__group-password">
                                        <input type="password" id="mat_khau" class="add-form__input" value="" minlength="8" data-parsley-minlength-message="Mật khẩu ít nhất 8 ký tự!">
                                        <span class="auth-form__password-show-hide" onclick="isShowHidePasswordEdit2()">
                                            <i class="fas fa-eye icon__eye-pass" id="eye__pass-register2"></i>
                                            <i class="fas fa-eye-slash icon__eye-slash-pass" id="eye-slash__pass-register2"></i>
                                        </span>
                                    </div>
                                </div>

                                <div class="add-form__group">
                                    <label class="add-form__name add-form__name-pass" for="">Nhập lại mật khẩu mới:</label>
                                    <div class="add-form__item auth-form__group-password">
                                        <input type="password" id="mat_khau_lai" class="add-form__input" value="" minlength="8" data-parsley-minlength-message="Mật khẩu lại ít nhất 8 ký tự!"
                                        data-parsley-equalto="#mat_khau" data-parsley-equalto-message="Mật khẩu lại không trùng khớp!">
                                        <span class="auth-form__password-show-hide" onclick="isShowHidePasswordEdit()">
                                            <i class="fas fa-eye icon__eye-pass" id="eye__pass-register"></i>
                                            <i class="fas fa-eye-slash icon__eye-slash-pass" id="eye-slash__pass-register"></i>
                                        </span>
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>
                </div>

                <div class="col_g l-3_g m-3_g c-12_g flex-ord1">
                    <div class="profile-avatar">
                        <div class="row_g row__banner" id="row-0-panel">
                            <div class="col_g l_12_g event-rght__ip event-rght__edit-account">
                                <div class="event-right__content event-right__content__edit-account">
                                    <input hidden class="form-control event-rght__input" id="event__input-0" name="duong_dan_banner" type="file" multiple placeholder="Nhập đường link" onchange="uploadBannerFile(this, 0)" accept=".jpg, .png">
                                    @if(auth()->user()->anh_dai_dien == NULL)
                                    <img class="event-right__img" id="event__img-0" src="{{asset('assets/img/avt_none.PNG')}}" alt="slider" style="border-radius: 50%;" width="120px" height="120px">
                                    @else
                                    <img class="event-right__img" id="event__img-0" src="../{{auth()->user()->anh_dai_dien}}" alt="slider" style="border-radius: 50%;" width="120px" height="120px">
                                    @endif
                                    <label for="event__input-0" class="event-rght__btn">Chọn Ảnh</label>
                                    <span>Dung lượng tối đa 1 MB</span>
                                    <span>Định dạng: .JPEG, .PNG</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col_g l-12_g m-12_g c-12_g flex-ord3">
                    <!-- Trở lại -->
                    <div class="add-form__controls edit-form__controls-info">
                        <a href="{{route('thong-tin-ho-so')}}" type="button" class="btn edit-form__controls btn--normal">HỦY</a>
                        <button class="btn edit-form__controls btn--primary">LƯU</button>
                    </div>
                </div>
            </div>
        </form>

    </div>
</div>
<!-- End Container -->
@endsection
@section('page-js')
<!-- delete and choose file -->
<script type="text/javascript">
    function uploadBannerFile(input, tam) {
        $('#id-label-' + tam).html(input.files[0].name);
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#event__img-' + tam).attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<!-- /delete and choose file -->

<script>
    $('#cap-nhat-thong-tin').submit(function(event) {
        event.preventDefault();
        if ($(this).parsley().isValid()) {
            var form = $(this);
            var url = form.attr('action');
            let add_banner = document.getElementsByName('duong_dan_banner');

            var formData = new FormData($(this)[0]);
            if (add_banner[0].files[0] != undefined) {
                formData.append('data_add_avatar', add_banner[0].files[0]);
            }

            formData.append('ho_ten', $('#ho_ten').val());
            formData.append('sdt', $('#sdt').val());
            formData.append('dia_chi', $('#dia_chi').val());
            formData.append('mat_khau_moi', $('#mat_khau').val() == '' ? '' : $('#mat_khau').val());
            formData.append('mat_khau_lai', $('#mat_khau_lai').val() == '' ? '' : $('#mat_khau_lai').val());

            $.ajax({
                type: 'POST',
                url: url,
                data: formData,
                async: false,
                cache: false,
                contentType: false,
                enctype: 'multipart/form-data',
                processData: false,
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
                            window.location.replace("{{route('thong-tin-ho-so')}}");
                        }, 1500);
                    } else {
                        $('.add-form__header.add-form__haeder-profile-info.add-form__add-account--center').after('<div class="alert alert-danger noti-alert-danger" role="alert" style="font-size: 1.5rem; margin-top: 10px;">' + data.message + '</div>');
                        window.setTimeout(function() {
                            $('.alert.alert-danger.noti-alert-danger').remove();
                        }, 5000);
                    }
                },
                error: function(response) {
                    $.each(response.responseJSON.errors, function(field_name, error) {
                            $('.add-form__header.add-form__haeder-profile-info.add-form__add-account--center').after('<div class="alert alert-danger noti-alert-danger" role="alert" style="font-size: 1.5rem; margin-top: 5px;">' + error + '</div>');
                        }),
                        window.setTimeout(function() {
                            $('.alert.alert-danger.noti-alert-danger').remove();
                        }, 2500);
                }
            });
        }
    });
</script>

<!-- Show hide password -->
<script>
    //  Show hide password
    function isShowHidePasswordEdit() {
        let inputPassword = document.getElementById('mat_khau_lai');
        let btnShow = document.getElementById('eye__pass-register');
        let btnHide = document.getElementById('eye-slash__pass-register');
        if (inputPassword.type === 'password') {
            inputPassword.type = 'text';
            btnHide.style.display = 'block'
            btnShow.style.display = 'none';
        } else {
            inputPassword.type = 'password';
            btnHide.style.display = 'none'
            btnShow.style.display = 'block';
        }
    }

    function isShowHidePasswordEdit2() {
        let inputPassword = document.getElementById('mat_khau');
        let btnShow = document.getElementById('eye__pass-register2');
        let btnHide = document.getElementById('eye-slash__pass-register2');
        if (inputPassword.type === 'password') {
            inputPassword.type = 'text';
            btnHide.style.display = 'block'
            btnShow.style.display = 'none';
        } else {
            inputPassword.type = 'password';
            btnHide.style.display = 'none'
            btnShow.style.display = 'block';
        }
    }
</script>
@endsection