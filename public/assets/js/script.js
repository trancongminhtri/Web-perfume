// forgotpassword
var openForgotPasswordForm = document.getElementById("forgotpassword-form"); //Lấy id form
var btnForgotPassword = document.getElementById("btn_forgotpassword"); //Lấy id nút quên mật khẩu
var btnBackForgotPassword = document.getElementById("btn__back-forgotpassword"); //Lấy id nút trở lại

btnForgotPassword.onclick = function() {
    openForgotPasswordForm.style.display = "block";
    openFormLogin.style.display = "none";
    openFormRegister.style.display = "none";
    document.querySelector('.input__email-forgotpass').focus();
}

btnBackForgotPassword.onclick = function() {
    openForgotPasswordForm.style.display = "none";
    openFormLogin.style.display = "block";
    setNullInputPassword();
}

// login
var openFormLogin = document.getElementById("login-form");
var btnLogin = document.getElementById("btn__login");
var btnBackLogin = document.getElementById("btn__back-login")
var btnRegisterForm = document.getElementById("btn__register-form");

var ipOtp = document.getElementById('code_otp');

function formLogin(){
    modal.style.display = "flex";
    openFormLogin.style.display = "block";
    openFormRegister.style.display = "none";
    openForgotPasswordForm.style.display = "none";
    openOTPForm.style.display = "none";
    setNullInputPassword();
    ipSendOTP.value = '';
    ipOtp.value = '';
    document.querySelector('.input__email-login').focus();
}

btnRegisterForm.onclick = function() {
    openFormLogin.style.display = "none";
    openFormRegister.style.display = "block";
    setNullValueInput();
    document.querySelector('.input__name-register').focus();
}

btnBackLogin.onclick = function() {
    modal.style.display = "none";
    openFormLogin.style.display = "none";
    setNullValueInput();
}

//otp
var openOTPForm = document.getElementById("otp-form"); //Lấy id form
var btnOTP = document.getElementById("btn__otp"); //Lấy id nút OK
var btnBackOPTForm = document.getElementById("btn__back-otp");//Lấy id nút trở lại
var ipSendOTP = document.getElementById("send_mail_otp") // input trong file quen-mat-khau.blade.php
var ipEMailOTP = document.getElementById("email_otp") // input trong file otp.blade.php

function formOTP(){
    ipEMailOTP.value = ipSendOTP.value;
    openOTPForm.style.display = "block";
    openForgotPasswordForm.style.display = "none";
    openFormRegister.style.display = "none";
    openFormLogin.style.display = "none";
    document.querySelector('.input__code-otp').focus();
    btnBackOPTForm.onclick = function() {
        openOTPForm.style.display = "none";
        openForgotPasswordForm.style.display = "block";
        setNullValueInput();
    }
}

//register
var modal = document.getElementById("modal");
var modalOverlay = document.getElementById("modal__overlay");
var openFormRegister = document.getElementById("register-form")
var btnRegister = document.getElementById("btn__register");
var btnLoginForm = document.getElementById("btn__login-form");

function formRegister() {
    modal.style.display = "flex";
    openFormRegister.style.display = "block";
    openFormLogin.style.display = "none";
    openOTPForm.style.display = "none";
    setNullValueInput();
    document.querySelector('.input__name-register').focus();
}

btnLoginForm.onclick = function() {
    openFormRegister.style.display = "none";
    openFormLogin.style.display = "block";
    setNullValueInput();
    document.querySelector('.input__email-login').focus();
}

modalOverlay.onclick = function() {
    modal.style.display = "none";
    openFormRegister.style.display = "none";
}

function backFormRegister() {
    modal.style.display = "none";
    openFormRegister.style.display = "none";
    setNullValueInput();
}
