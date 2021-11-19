 <!-- Register form -->
 <div class="auth-form" id="register-form">
     <div class="auth-form__container">
         <div class="auth-form__header">
             <h3 class="auth-form__haeding">Đăng ký</h3>
             <span class="auth-form__switch-btn" id="btn__login-form">Đăng nhập</span>
         </div>

         <div class="auth-form__form">
             <form action="{{route('nguoidung.dang-ky')}}" id="dang-ky" method="POST" data-parsley-validate>
             @csrf
                 <div class="auth-form__group">
                     <input type="text" class="auth-form__input input__name-register" placeholder="Họ tên" name="ho_ten"
                     required data-parsley-required-message="Vui lòng nhập họ tên!" minlength="6" data-parsley-minlength-message="Họ tên ít nhất 6 ký tự!">
                 </div>

                 <div class="auth-form__group">
                     <input type="text" class="auth-form__input" placeholder="Email" name="email"
                     required data-parsley-required-message="Vui lòng nhập email!"
                     data-parsley-type="email" data-parsley-type-message="Email không đúng định dạng!">
                 </div>

                 <div class="auth-form__group">
                     <input type="number" class="auth-form__input auth-form__input-number" placeholder="Số điện thoại" name="sdt"
                     required data-parsley-required-message="Vui lòng nhập số điện thoại!"
                     data-parsley-length="[10, 10]"  data-parsley-length-message="Số điện thoại không đúng!"
                     data-parsley-type="integer" data-parsley-type-message="Số điện thoại không đúng!">
                 </div>

                 <div class="auth-form__group">
                     <input type="text" class="auth-form__input" placeholder="Địa chỉ" name="dia_chi"
                     required data-parsley-required-message="Vui lòng nhập địa chi!">
                 </div>

                 <div class="auth-form__group auth-form__group-password">
                     <input type="password" class="auth-form__input" id="mat_khau" placeholder="Mật khẩu" name="mat_khau"
                     required data-parsley-required-message="Vui lòng nhập mật khẩu!"
                     minlength="8" data-parsley-minlength-message="Mật khẩu ít nhất 8 ký tự!">
                     <span class="auth-form__password-show-hide" onclick="isShowHidePasswordRegister2()">
                            <i class="fas fa-eye icon__eye-pass" id="eye__pass-register2"></i>
                            <i class="fas fa-eye-slash icon__eye-slash-pass" id="eye-slash__pass-register2"></i>
                    </span>
                 </div>

                 <div class="auth-form__group auth-form__group-password">
                     <input type="password" id="input__pass-register" class="auth-form__input" placeholder="Nhập lại mật khẩu" name="mat_khau_lai"
                     required data-parsley-required-message="Vui lòng nhập lại mật khẩu!"
                     minlength="8" data-parsley-minlength-message="Mật khẩu lại ít nhất 8 ký tự!"
                     data-parsley-equalto="#mat_khau" data-parsley-equalto-message="Mật khẩu lại không trùng khớp!">
                        <span class="auth-form__password-show-hide" onclick="isShowHidePasswordRegister()">
                            <i class="fas fa-eye icon__eye-pass" id="eye__pass-register"></i>
                            <i class="fas fa-eye-slash icon__eye-slash-pass" id="eye-slash__pass-register"></i>
                        </span>
                 </div>

                 <div class="auth-form-aside">
                     <p class="auth-form__policy-text">
                         Bằng việc đăng ký bạn đã đồng ý với Perfume về
                         <a class="auth-form__text-link">Điều khoản dịch vụ</a> &
                         <a class="auth-form__text-link">Chính sách bảo mật</a>
                     </p>
                 </div>

                 <div class="auth-form__controls">
                     <button type="button" class="btn auth-form__controls-back btn--normal" onclick="backFormRegister()">TRỞ LẠI</button>
                     <button type="submit" class="btn btn--primary btn__register">
                         <span class="btn__register-text">ĐĂNG KÝ</span>
                     </button>
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