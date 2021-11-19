<!-- Forgot Password -->
<div class="auth-form" id="forgotpassword-form">
    <div class="auth-form__container">
        <div class="auth-form__header auth-form__forgotpassword--center">
            <h3 class="auth-form__haeding">Nhập Email</h3>
        </div>
        <div class="auth-form__form">
            <form action="{{route('nguoidung.gui-ma-otp')}}" id="quen-mat-khau" method="POST" data-parsley-validate>
                @csrf
                <div class="auth-form__group">
                    <input type="text" name="email" id="send_mail_otp" class="auth-form__input input__email-forgotpass" placeholder="Email"
                    required data-parsley-required-message="Vui lòng nhập email!" 
                    data-parsley-type="email" data-parsley-type-message="Email không đúng định dạng!">
                </div>
                <div class="auth-form__controls">
                    <button type="button" class="btn auth-form__controls-back btn--normal" id="btn__back-forgotpassword">TRỞ LẠI</button>
                    <button type="submit" class="btn btn--primary btn__email" id="btn__otp">
                        <span class="btn__email-text">OK</span>
                    </button>
                </div>      
            </form>
        </div>
    </div>
</div>