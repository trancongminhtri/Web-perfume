@extends('admin.layout-admin')
@section('title')
@endsection
@section('content')
<!-- End Slider -->
<div class="content-admin content-admin__ckeditor">
    <div class="grid_g">
        <div class="add-form__header add-form__add-account--center add-form__haeder-product">
            <h3 class="add-form__haeding add-form__haeding-product">Cập Nhật Khuyến Mãi</h3>
        </div>

        <form action="{{route('quanly.cap-nhat-khuyen-mai', $timKhuyenMai['id'])}}" method="POST" id="cap-nhat-khuyen-mai" data-parsley-validate>
            @csrf
            <div class="row_g no-gutters">
                <div class="col_g l-12_g m-12_g">
                    <div class="add-form__group add-form__group-mt">
                        <label>Tên khuyến mãi:</label>
                        <div class="add-form__item">
                            <input type="text" class="add-form__input add-form__input-promotion" name="ten_khuyen_mai" value="{{$timKhuyenMai['ten_khuyen_mai']}}"
                            placeholder="Tên khuyến mãi" required data-parsley-required-message="Vui lòng nhập tên khuyến mãi!">
                        </div>
                    </div>
                </div>

                <div class="col_g l-12_g m-12_g">
                    <div class="add-form__group add-form__group-promotion add-form__group-mt">
                        <label style="width:142px">Giá khuyến mãi(%):</label>
                        <div class="add-form__item">
                            <input type="number" class="add-form__input add-form__input-promotion" name="gia_khuyen_mai" value="{{$timKhuyenMai['gia_khuyen_mai']}}"
                            placeholder="Giá khuyến mãi" required data-parsley-required-message="Vui lòng nhập giá khuyến mãi!">
                        </div>
                    </div>
                </div>

                <div class="col_g l-12_g m-12_g">
                    <div class="add-form__group add-form__group-mt">
                        <label>Ngày bắt đầu:</label>
                        <div class="add-form__item">
                            <input type="date" class="add-form__input add-form__input-promotion" name="ngay_bat_dau" 
                            value="{{ \Carbon\Carbon::parse($timKhuyenMai->ngay_bat_dau)->format('Y-m-d')}}"
                            required data-parsley-required-message="Vui lòng chọn ngày bắt đầu!">
                        </div>
                    </div>
                </div>

                <div class="col_g l-12_g m-12_g">
                    <div class="add-form__group add-form__group-promotion add-form__group-mt">
                        <label id="ngay_ket_thuc-label">Ngày kết thúc:</label>
                        <div class="add-form__item">
                            <input type="date" class="add-form__input add-form__input-promotion" id="ngay_ket_thuc" name="ngay_ket_thuc" 
                            value="{{$timKhuyenMai->ngay_ket_thuc == null ? \Carbon\Carbon::parse($now)->format('Y-m-d') : \Carbon\Carbon::parse($timKhuyenMai->ngay_ket_thuc)->format('Y-m-d')}}">
                        </div>
                    </div>
                </div>

                <div class="col_g l-12_g m-12_g">
                    <div class="add-form__group  add-form__group-never-expires">
                        <input type="checkbox" id="never-expires" class="add-form__input-check" name="vo_han" {{$timKhuyenMai->ngay_ket_thuc == null ? 'checked' : ''}}>
                        <label for="never-expires" class="never-expires__name">Không bao giờ hết hạn</label>
                    </div>
                </div>

            </div>

            <div class="row_g row__add-product row__add-promotion">
                <div class="col_g l-12_g m-12_g">
                    <div class="add-form__controls add-form__controls-add-product">
                        <a href="{{route('quanly.ql-khuyen-mai')}}" type="button" class="btn add-form__controls-back btn--normal btn--des-account">HỦY</a>
                        <button class="btn btn--primary btn--add-product">LƯU</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('page-js')
<!-- Cập nhật khuyến mãi -->
<script>
    $('#cap-nhat-khuyen-mai').submit(function(e) {
        e.preventDefault();
        if ($(this).parsley().isValid()) {
            var form = $(this);
            var url = form.attr('action');
            $.ajax({
                type: "POST",
                url: url,
                data: form.serialize(),
                success: function(data) {
                    if (data.status == 'error') {
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: data.message,
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
                    if (data.status == 'success') {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: data.message,
                            showConfirmButton: false,
                            timer: 1500
                        })
                        window.setTimeout(function(){
                            window.location.replace("{{route('quanly.ql-khuyen-mai')}}");
                        },1500);
                    }
                },
                error: function(response) {
                    $.each(response.responseJSON.errors, function(field_name, errors) {
                            $('.add-form__header.add-form__add-account--center').before('<div class="alert alert-danger noti-alert-danger" role="alert" style="font-size: 1.5rem;">' + errors + '</div>');
                        }),
                        window.setTimeout(function() {
                            $('.alert.alert-danger.noti-alert-danger').remove();
                        }, 2500);
                }
            });
        }
    });
</script>

<!-- Tắt mở ngày kết thúc -->
<script>
$(document).ready(function(){
    if($('#never-expires').is(':checked')){
        $('#ngay_ket_thuc').prop( "disabled", true );
        $('#ngay_ket_thuc-label').css('text-decoration-line', 'line-through');
    }
});
$('#never-expires').click(function(){
    if($('#never-expires').is(':checked')){
        $('#ngay_ket_thuc').prop( "disabled", true );
        $('#ngay_ket_thuc-label').css('text-decoration-line', 'line-through');
    }else{
        $('#ngay_ket_thuc').prop( "disabled", false );
        $('#ngay_ket_thuc-label').css('text-decoration-line', 'none');
    }
});
</script>
@endsection