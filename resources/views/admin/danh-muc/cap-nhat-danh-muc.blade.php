<div class="add-form__container">
    <div class="add-form__header add-form__add-account--center">
        <h3 class="add-form__haeding ">Cập nhật danh mục</h3>
    </div>

    <form action="{{route('quanly.cap-nhat-danh-muc', $kt_danh_muc['id'])}}" id="cap-nhat-danh-muc" method="POST" data-parsley-validate>
        @csrf
        <div class="add-form__form">
            <div class="add-form__group">
                <label for="">Tên danh mục:</label>
                <div class="add-form__item">
                    <input type="text" class="add-form__input" placeholder="Tên danh mục" name="ten_danh_muc" value="{{$kt_danh_muc['ten_danh_muc'] == null ? '' : $kt_danh_muc['ten_danh_muc']}}" required data-parsley-required-message="Vui lòng nhập tên danh mục">
                </div>
            </div>

            <div class="add-form__controls">
                <button type="button" class="btn add-form__controls-back btn--normal" onclick="backAddCategory()">HỦY</button>
                <button class="btn btn--primary">LƯU</button>
            </div>

        </div>
    </form>

</div>

<!-- Cập nhật danh mục -->
<script src="{{asset('assets/js/parsleyjs/js/parsley.min.js')}}"></script>
<script>
    $('#cap-nhat-danh-muc').submit(function(e) {
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
                        backAddCategory();
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: data.message,
                            showConfirmButton: false,
                            timer: 1500
                        })
                        $('#nuoc-hoa-danh-muc').empty();
                        $('#nuoc-hoa-danh-muc').html(data.giao_dien_nuoc_hoa);
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
                            $('#cap-nhat-danh-muc').before('<div class="alert alert-danger noti-alert-danger" role="alert" style="font-size: 1.5rem;">' + errors + '</div>');
                        }),
                        window.setTimeout(function() {
                            $('.alert.alert-danger.noti-alert-danger').remove();
                        }, 2500);
                }
            })
        }
    });
</script>