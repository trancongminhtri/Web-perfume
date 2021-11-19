<!-- Edit NCC form id="add__account-form"-->

<div class="add-form__container">
    <div class="add-form__header add-form__add-account--center">
        <h3 class="add-form__haeding ">Cập Nhật Nhà Cung Cấp</h3>
    </div>

    <form action="{{route('quanly.cap-nhat-ncc', $kt_ncc['id'])}}" id="cap-nhat-ncc" method="POST" data-parsley-validate>
        @csrf
        <div class="add-form__form">
            <div class="add-form__group">
                <label for="">Tên nhà cung cấp:</label>
                <div class="add-form__item">
                    <input type="text" class="add-form__input" placeholder="Tên nhà cung cấp" name="ten_ncc" value="{{$kt_ncc['ten_ncc']}}" required data-parsley-required-message="Vui lòng nhập Tên nhà cung cấp!">
                </div>
            </div>

            <div class="add-form__group">
                <label for="">Số điện thoại:</label>
                <div class="add-form__item">
                    <input type="number" class="add-form__input add-form__input-number" placeholder="Số điện thoại" name="sdt_ncc" value="{{$kt_ncc['sdt_ncc']}}" required data-parsley-required-message="Vui lòng nhập Số điện thoại!" data-parsley-length="[10, 10]" data-parsley-length-message="Số điện thoại không đúng!">
                </div>
            </div>

            <div class="add-form__group">
                <label for="">Email:</label>
                <div class="add-form__item">
                    <input type="email" class="add-form__input" placeholder="Email" name="email_ncc" value="{{$kt_ncc['email_ncc']}}" required data-parsley-required-message="Vui lòng nhập email!" data-parsley-type="email" data-parsley-type-message="Email không đúng định dạng!">
                </div>
            </div>

            <div class="add-form__group">
                <label for="">Địa chỉ:</label>
                <div class="add-form__item">
                    <input type="text" class="add-form__input" placeholder="Địa chỉ" name="dia_chi_ncc" value="{{$kt_ncc['dia_chi_ncc']}}" required data-parsley-required-message="Vui lòng nhập Địa chỉ!">
                </div>
            </div>

            <div class="add-form__controls">
                <button type="button" class="btn add-form__controls-back btn--normal" onclick="backAddNcc()">HỦY</button>
                <button class="btn btn--primary">LƯU</button>
            </div>

        </div>
    </form>

</div>

<!-- Cập nhật nhà cung cấp -->
<script src="{{asset('assets/js/parsleyjs/js/parsley.min.js')}}"></script>
<script>
    $('#cap-nhat-ncc').submit(function(e) {
        e.preventDefault();
        if ($(this).parsley().isValid()) {
            var form = $(this);
            var url = form.attr('action');
            $.ajax({
                type: 'POST',
                url: url,
                data: form.serialize(),
                success: function(data) {
                    if (data.status == 'success') {
                        backAddNcc();
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: data.message,
                            showConfirmButton: false,
                            timer: 1500
                        })
                        $('#bang-ncc').empty();
                        $('#bang-ncc').html(data.giao_dien_ncc);
                    }
                    if (data.status == 'error') {
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: data.message,
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
                },
                error: function(response) {
                    $.each(response.responseJSON.errors, function(field_name, errors) {
                            $('#cap-nhat-ncc').before('<div class="alert alert-danger noti-alert-danger" role="alert" style="font-size: 1.5rem;">' + errors + '</div>');
                        }),
                        window.setTimeout(function() {
                            $('.alert.alert-danger.noti-alert-danger').remove();
                        }, 2500);
                }
            })
        }
    });
</script>