<script src="{{asset('assets/js/jquery-3.6.0.min.js')}}"></script>
<script src="{{asset('assets/js/parsleyjs/js/parsley.min.js')}}"></script>
<script src="{{asset('assets/sweetarlet2/node_modules/sweetalert2/dist/sweetalert2.js')}}"></script>
<!-- BOOTSTRAP -->
<script src="{{asset('assets/bootstrap/js/bootstrap.min.js')}}"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.nav_btn').click(function() {
            $('.mobile-nav-items').toggleClass('active');
        });
    });
</script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

<!-- Set value null after submit -->
<script>
    function setNullValue() {
        $('input[type="text"]').val('');
        $('input[type="number"]').val('');
        $('input[type="email"]').val('');
        // $('input[type="date"]').val('');
    }
</script>

<!-- Các input type number đều không nhập được giá trị âm và số thực -->
<script>
    var number = document.querySelectorAll('input[type="number"]');
    for(var i = 0; i < number.length; i++){
        // Listen for input event on numInput.
        number[i].onkeydown = function(e) {
            if(!((e.keyCode > 95 && e.keyCode < 106)
            || (e.keyCode > 47 && e.keyCode < 58) 
            || e.keyCode == 8)) {
                return false;
            }
        }
    }
</script>

<!-- Loading -->
<script >
    $(window).on('load', function() {
        $('.loading').fadeOut('linear');
    });
</script>

<script>
    // Password show hide password
    function isShowHidePasswordAdd() {
        let inputPassword = document.getElementById('mat_khau');
        let btnShow = document.getElementById('eye__password');
        let btnHide = document.getElementById('eye-slash__password');
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

    // Re-password show hide password
    function isShowHidePasswordRePassword() {
        let inputPassword = document.getElementById('input__pass-re-password');
        let btnShow = document.getElementById('eye__pass-re-password');
        let btnHide = document.getElementById('eye-slash__pass-re-password');
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