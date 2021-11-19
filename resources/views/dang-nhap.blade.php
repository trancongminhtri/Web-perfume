<div class="auth-form" id="login-form">
    <div class="auth-form__container">
        <div class="auth-form__header">
            <h3 class="auth-form__haeding">Đăng nhập</h3>
            <span class="auth-form__switch-btn" id="btn__register-form" onclick="formRegister()">Đăng ký</span>
        </div>

        <div class="auth-form__form">
            <form action="{{ route('nguoidung.dang-nhap') }}" id="dang-nhap" method="POST" data-parsley-validate>
                @csrf
                <div class="auth-form__group">
                    <input  type="text" class="auth-form__input input__email-login" name="email" placeholder="Email" required data-parsley-required-message="Vui lòng nhập email!" data-parsley-type="email" data-parsley-type-message="Email không đúng định dạng!">
                </div>

                <div class="auth-form__group auth-form__group-password">
                    <input type="password" class="auth-form__input" placeholder="Mật khẩu" id="input-pass" name="password" required data-parsley-required-message="Vui lòng nhập mật khẩu!">
                    <span class="auth-form__password-show-hide" onclick="isShowHidePasswordLogin()">
                        <i class="fas fa-eye icon__eye-pass" id="eye-pass"></i>
                        <i class="fas fa-eye-slash icon__eye-slash-pass" id="eye-slash-pass"></i>
                    </span>
                </div>

                <div class="auth-form-aside">
                    <div class="auth-form__help">
                        <a id="btn_forgotpassword" class="auth-form__help-link auth-form__help-link--saparate auth-form__help-forgot">
                            Quên mật khẩu
                        </a>
                        <a href="" class="auth-form__help-link auth-form__helped">Cần trợ giúp ?</a>
                    </div>
                </div>

                <div class="auth-form__controls">
                    <button type="button" class="btn auth-form__controls-back btn--normal" id="btn__back-login">TRỞ LẠI</button>
                    <button type="submit" class="btn btn--primary">ĐĂNG NHẬP</button>
                </div>
            </form>
        </div>

    </div>
    <div class="auth-form__socials">
        <a href="" class="auth-form__socials--facebook btn btn--size-s btn--switch-icon">
            <i class="fab fa-facebook-square auth-form__socials-icons"></i>
            <span class="auth-form__socials-title">Kết nối với facebook</span>
        </a>

        <a href="" class="auth-form__socials--google btn btn--size-s btn--switch-icon">
            <img src="" alt="" class="auth-form__socials-google-icon">
            <span class="auth-form__socials-title"> Kết nối với Google</span>
        </a>
    </div>
</div>