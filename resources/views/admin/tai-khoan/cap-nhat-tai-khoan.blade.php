@extends('admin.layout-admin')
@section('title')
@endsection
@section('content')
<!-- End Slider -->
<div class="content-admin">
    <div class="grid_g">
        <div class="add-form__header add-form__haeder-profile-info add-form__add-account--center">
            <h3 class="add-form__haeding add-form__haeding-profile-info">Thông Tin Cá Nhân</h3>
        </div>

        <!-- Thông tin cá nhân -->
        <form action="{{route('quanly.cap-nhat-thong-tin')}}" method="POST" id="cap-nhat-thong-tin" data-parsley-validate>
            @csrf
            <div class="row_g">
                <div class="col_g l-7_g m-7_g c-12_g">
                    <div class="add-form add-form__profile-info">
                        <div class="add-form__container add-form__container-profile-info">

                            <div class="add-form__form">

                                <div class="add-form__group">
                                    <label class="add-form__name" for="">Email:</label>
                                    <div class="add-form__item">
                                        <input readonly type="email" value="{{$item_user['email']}}" class="add-form__input add-form__input-email">
                                    </div>
                                </div>

                                <div class="add-form__group">
                                    <label class="add-form__name" for="">Họ tên:</label>
                                    <div class="add-form__item">
                                        <input type="text" class="add-form__input" id="ho_ten" name="ho_ten" value="{{$item_user['ho_ten']}}" required data-parsley-required-message="Vui lòng nhập họ tên!" minlength="6" data-parsley-minlength-message="Họ tên ít nhất 6 ký tự!">
                                    </div>
                                </div>

                                <div class="add-form__group">
                                    <label class="add-form__name" for="">Số điện thoại:</label>
                                    <div class="add-form__item">
                                        <input type="number" class="add-form__input add-form__input-number" id="sdt" name="sdt" value="{{$item_user['sdt']}}" required data-parsley-required-message="Vui lòng nhập số điện thoại!">
                                    </div>
                                </div>

                                <div class="add-form__group add-form__group-textarea">
                                    <label class="add-form__name" for="">Địa chỉ:</label>
                                    <div class="add-form__item">
                                        <input type="text" class="add-form__input add-form__textarea" id="dia_chi" name="dia_chi" value="{{$item_user['dia_chi']}}" required data-parsley-required-message="Vui lòng nhập địa chỉ!">
                                    </div>
                                </div>

                                <div class="add-form__group change-password__title">
                                    <h3>Đổi mật khẩu</h3>
                                </div>

                                <div class="add-form__group add-form__group-textarea">
                                    <label class="add-form__name" for="">Mật khẩu mới:</label>
                                    <div class="add-form__item auth-form__group-password">
                                        <input type="password" class="add-form__input add-form__textarea" id="mat_khau_moi" name="mat_khau_moi" placeholder="Nhập mật khẩu mới!" minlength="8" data-parsley-minlength-message="Mật khẩu ít nhất 8 ký tự!">
                                        <span class="auth-form__password-show-hide" onclick="isShowHidePasswordEdit2()">
                                            <i class="fas fa-eye icon__eye-pass" id="eye__pass-register2"></i>
                                            <i class="fas fa-eye-slash icon__eye-slash-pass" id="eye-slash__pass-register2"></i>
                                        </span>
                                    </div>
                                </div>

                                <div class="add-form__group add-form__group-textarea">
                                    <label class="add-form__name" for="">Nhập lại mật khẩu mới:</label>
                                    <div class="add-form__item auth-form__group-password">
                                        <input type="password" class="add-form__input add-form__textarea" id="mat_khau_lai" name="mat_khau_lai" placeholder="Nhập lại mật khẩu!" minlength="8" data-parsley-minlength-message="Mật khẩu lại ít nhất 8 ký tự!"
                                        data-parsley-equalto="#mat_khau_moi" data-parsley-equalto-message="Mật khẩu lại không trùng khớp!">
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

                <div class="col_g l-5_g  m-5_g ">
                    <div class="row_g row__banner" id="row-0-panel">
                        <div class="col_g l_12_g event-rght__ip event-rght__edit-account">
                            <div class="event-right__content event-right__content__edit-account">
                                <input hidden class="form-control event-rght__input" id="event__input-0" name="duong_dan_banner" type="file" multiple placeholder="Nhập đường link" onchange="uploadBannerFile(this, 0)" accept=".jpg, .png">
                                <img class="event-right__img" id="event__img-0"  alt="slider" style="border-radius: 50%;" width="200px" height="200px"
                                @if(isset($item_user->anh_dai_dien))
                                    src="../{{$item_user->anh_dai_dien}}"
                                @else
                                src="{{asset('assets/img/avt_none.PNG')}}"
                                @endif;
                                >
                                <label for="event__input-0" class="event-rght__btn">Chọn Ảnh</label>
                                <span>Dung lượng tối đa 1 MB</span>
                                <span>Định dạng: .JPEG, .PNG</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row_g row__add-product">
                <div class="col_g l-12_g m-12_g c-12_g">
                    <div class="add-form__controls add-form__controls-edit-acount">
                        <a href="{{route('quanly.ql-tai-khoan')}}" class="btn btn__list-order-back add-form__controls-back btn--normal">TRỞ LẠI</a>
                        <button class="btn btn--primary btn--add-product ">CẬP NHẬT</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('page-js')
<script type="text/javascript">
    function trash(index1) {
        $('#row_g-' + index1 + '-panel').remove();
    }

    function uploadBannerFile(input, tam) {
        $('#id-label-' + tam).html(input.files[0].name);
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#event__img-' + tam).attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
        $('#event__input-' + tam).change(function() {
            readURL(this);
        });
    }
</script>
<!-- /delete and choose file -->

<!-- UI -->
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {

            var reader = new FileReader();

            reader.onload = function(e) {
                $('.event__image-upload-wrap').hide();
                $('.file-upload-input').hide();

                $('.file-upload-image').attr('src', e.target.result);
                $('.file-upload-content').show();

                $('.image-title').html(input.files[0].name);
            };

            reader.readAsDataURL(input.files[0]);

        } else {
            removeUpload();
        }
    }

    function removeUpload() {
        $('.file-upload-input').replaceWith($('.file-upload-input').clone());
        $('.file-upload-input').val('');
        $('.file-upload-content').hide();
        $('.event__image-upload-wrap').show();
    }
    $('.event__image-upload-wrap').bind('dragover', function() {
        $('.event__image-upload-wrap').addClass('image-dropping');
    });
    $('.event__image-upload-wrap').bind('dragleave', function() {
        $('.event__image-upload-wrap').removeClass('image-dropping');
    });
</script>

<!-- Cập nhật thông tin -->
<script>
    $('#cap-nhat-thong-tin').submit(function(event) {
        event.preventDefault();
        if ($(this).parsley().isValid()) {
            var form = $(this);
            var url = form.attr('action');
            let add_avatar = document.getElementsByName('duong_dan_banner');

            // Khai báo formData
            var formData = new FormData($(this)[0]);
            if (add_avatar[0].files[0] != undefined) {
                formData.append('data_add_avatar', add_avatar[0].files[0]);
            }

            // formData dữ liệu từ form
            formData.append('ho_ten', $('#ho_ten').val());
            formData.append('sdt', $('#sdt').val());
            formData.append('dia_chi', $('#dia_chi').val());
            formData.append('mat_khau_moi', $('#mat_khau_moi').val());
            formData.append('mat_khau_lai', $('#mat_khau_lai').val());
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
                            location.reload();
                        }, 1500);
                    } else {
                        $('.grid_g').before('<div class="alert alert-danger noti-alert-danger" role="alert" style="font-size: 1.5rem;">' + data.message + '</div>');
                        window.setTimeout(function() {
                            $('.alert.alert-danger.noti-alert-danger').remove();
                        }, 5000);
                    }
                },
                error: function(response) {
                    $.each(response.responseJSON.errors, function(field_name, error) {
                            $('.add-form__header.add-form__add-account--center').before('<div class="alert alert-danger noti-alert-danger" role="alert" style="font-size: 1.5rem;">' + error + '</div>');
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
        let inputPassword = document.getElementById('mat_khau_moi');
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