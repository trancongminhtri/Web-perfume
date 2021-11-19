<!-- Modal Layout Login -->
<div class="modal-add-edit" id="modal-add-edit">
    <!-- .modal để chiếm hết màn hình id="modal-add-edit"-->
    <div class="modal__overlay" id="modal__overlay-add-edit">
        <!-- modal__overlay tạo lớp phủ mờ id="modal__overlay-add-edit" -->
    </div>
    <div class="modal__body" id="modal__body-add-edit">
        <!-- modal__body để canh chỉnh kích thước, vị trí khung chứa content  -->

        <!-- Add Accont form id="add__account-form"-->
        <div class="add-form" id="add-form__account">
            <div class="add-form__container">
                <div class="add-form__header add-form__add-account--center">
                    <h3 class="add-form__haeding ">Thêm Tài Khoản</h3>
                </div>
                <form action="{{route('quanly.them-tai-khoan')}}" id="them-tai-khoan" method="POST" data-parsley-validate>
                    @csrf
                    <div class="add-form__form">
                        <div class="add-form__group">
                            <label for="">Họ tên:</label>
                            <div class="add-form__item">
                                <input type="text" class="add-form__input input__name-account" name="ho_ten" placeholder="Họ tên" required data-parsley-required-message="Vui lòng nhập họ tên!"  minlength="6" data-parsley-minlength-message="Họ tên ít nhất 6 ký tự!">
                            </div>
                        </div>

                        <div class="add-form__group">
                            <label for="">Email:</label>
                            <div class="add-form__item">
                                <input type="text" class="add-form__input" name="email" placeholder="Email" required data-parsley-required-message="Vui lòng nhập email!" data-parsley-type="email" data-parsley-type-message="Email không đúng định dạng!">
                            </div>
                        </div>

                        <div class="add-form__group">
                            <label for="">Số điện thoại:</label>
                            <div class="add-form__item">
                                <input type="number" class="add-form__input add-form__input-number" name="sdt" placeholder="Số điện thoại" required data-parsley-required-message="Vui lòng nhập số điện thoại!" data-parsley-length="[10, 10]" data-parsley-length-message="Số điện thoại không đúng!" data-parsley-type="integer" data-parsley-type-message="Số điện thoại không đúng!">
                            </div>
                        </div>

                        <div class="add-form__group">
                            <label class="add-account__label-address" for="">Địa chỉ:</label>
                            <div class="add-form__item">
                                <textarea type="text" class="add-form__input add-form__textarea-account" name="dia_chi" placeholder="Địa chỉ" required data-parsley-required-message="Vui lòng nhập địa chi!"></textarea>
                            </div>
                        </div>

                        <div class="add-form__group">
                            <label for="">Mật khẩu:</label>
                            <div class="add-form__item" style="position:relative">
                                <input type="password" class="add-form__input" name="mat_khau" id="mat_khau" placeholder="Mật khẩu" required data-parsley-required-message="Vui lòng nhập mật khẩu!" minlength="8" data-parsley-minlength-message="Mật khẩu ít nhất 8 ký tự!">
                                <span class="auth-form__password-show-hide" onclick="isShowHidePasswordAdd()">
                                    <i class="fas fa-eye icon__eye-pass" id="eye__password"></i>
                                    <i class="fas fa-eye-slash icon__eye-slash-pass" id="eye-slash__password"></i>
                                </span>
                            </div>
                        </div>

                        <div class="add-form__group">
                            <label for="">Nhập lại mật khẩu:</label>
                            <div class="add-form__item" style="position:relative">
                                <input type="password" id="input__pass-re-password" class="add-form__input" name="mat_khau_lai" placeholder="Nhập lại mật khẩu" required data-parsley-required-message="Vui lòng nhập lại mật khẩu!" minlength="8" data-parsley-minlength-message="Mật khẩu lại ít nhất 8 ký tự!" data-parsley-equalto="#mat_khau" data-parsley-equalto-message="Mật khẩu không trùng khớp!">
                                <span class="auth-form__password-show-hide" onclick="isShowHidePasswordRePassword()">
                                    <i class="fas fa-eye icon__eye-pass" id="eye__pass-re-password"></i>
                                    <i class="fas fa-eye-slash icon__eye-slash-pass" id="eye-slash__pass-re-password"></i>
                                </span>
                            </div>
                        </div>
                        <div class="add-form__controls">
                            <button type="button" class="btn add-form__controls-back btn--normal" id="btn__back-account" onclick="backAddAccount()">HỦY</button>
                            <button type="submit" class="btn btn--primary">LƯU</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>