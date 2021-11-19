<!-- Edit Trademark form id="add__account-form"-->
<div class="add-form__container">
    <div class="add-form__header add-form__add-account--center">
        <h3 class="add-form__haeding ">Cập Nhật Thương Hiệu</h3>
    </div>

    <form action="{{route('quanly.cap-nhat-thuong-hieu', $kt_thuong_hieu['id'])}}" id="cap-nhat-thuong-hieu" method="post" data-parsley-validate>
        @csrf
        <div class="add-form__form">
            <div class="add-form__group">
                <label for="">Tên thương hiệu:</label>
                <div class="add-form__item">
                    <input type="text" class="add-form__input" name="ten_thuong_hieu" value="{{$kt_thuong_hieu['ten_thuong_hieu']}}" required data-parsley-required-message="Vui lòng nhập tên thương hiệu!">
                </div>
            </div>

            <div class="add-form__controls">
                <button type="button" class="btn add-form__controls-back btn--normal" onclick="backAddTrademark()">HỦY</button>
                <button class="btn btn--primary">LƯU</button>
            </div>

        </div>
    </form>

</div>

<!-- Cập nhật thương hiệu -->
<script src="{{asset('assets/js/parsleyjs/js/parsley.min.js')}}"></script>
<script>
    $('#cap-nhat-thuong-hieu').submit(function(e) {
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
                        backAddTrademark();
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: data.message,
                            showConfirmButton: false,
                            timer: 1500
                        })
                        $('#bang-thuong-hieu').empty();
                        $('#bang-thuong-hieu').html(data.giao_dien_bang);
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
                            $('#cap-nhat-thuong-hieu').before('<div class="alert alert-danger noti-alert-danger" role="alert" style="font-size: 1.5rem;">' + errors + '</div>');
                        }),
                        window.setTimeout(function() {
                            $('.alert.alert-danger.noti-alert-danger').remove();
                        }, 2500);
                }
            })
        }
    });
</script>