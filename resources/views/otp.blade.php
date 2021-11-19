<!-- OPT -->
    <div class="auth-form" id="otp-form">
        <div class="auth-form__container">
            <div class="auth-form__header auth-form__opt--center">
                <h3 class="auth-form__haeding" >Nhập mã OTP</h3>
            </div>
                <div class="auth-form__form">
                    <form action="{{route('nguoidung.nhap-ma-otp')}}" id="form-otp" method="POST" data-parsley-validate>
                    @csrf
                        <div class="auth-form__group">
                            <input type="text" name="email_otp" id="email_otp" hidden>
                            <input type="text" id="code_otp" name="code_otp" class="auth-form__input input__code-otp" placeholder="OTP"
                            required data-parsley-required-message="Vui lòng nhập mã OTP!"
                            data-parsley-length="[8, 8]"  data-parsley-length-message="Mã OTP không đúng!">
                        </div>
                        <div class="auth-form__controls">
                            <button type="button" class="btn auth-form__controls-back btn--normal" id="btn__back-otp">TRỞ LẠI</button>
                            <button class="btn btn--primary btn__otp" id="btn__password-new">
                                <span class="btn__otp-text">XÁC NHẬN</span>
                            </button>
                        </div>
                    </form>
                </div>
        </div>           
    </div>