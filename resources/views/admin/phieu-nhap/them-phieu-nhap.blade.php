@extends('admin.layout-admin')
@section('title')
@endsection
@section('content')
<div class="content-admin content-admin__ckeditor">
    <div class="grid_g wide_g wide_g-tablet">
        <div class="add-form__header add-form__add-account--center add-form__haeder-product">
            <h3 class="add-form__haeding add-form__haeding-product">Thêm phiếu nhập</h3>
        </div>
        <form action="{{route('quanly.them-phieu-nhap')}}" id="them-phieu-nhap" method="POST" data-parsley-validate>
            @csrf
            <div class="add-form__container add-form__container-account">
                <div class="row_g">
                    <div class="col_g l-6_g m-6_g">
                        <div class="add-form__group add-form__item-position">
                            <label>Tổng số lượng:</label>
                            <div class="add-form__item">
                                <input style="background: rgba(0, 0, 0, 0.1);" type="number" disabled class="add-form__input add-form__input-number" id="tong-so-luong-nhap" name="tong-so-luong-nhap" placeholder="Tổng số lượng nhập">
                            </div>
                        </div>
                    </div>

                    <div class="col_g l-6_g m-6_g">
                        <div class="add-form__group add-form__item-position">
                            <label>Tổng tiền:</label>
                            <div class="add-form__item">
                                <input style="background: rgba(0, 0, 0, 0.1);" type="number" disabled class="add-form__input add-form__input-number" id="tong-tien-nhap" name="tong-tien-nhap" placeholder="Tổng tiền nhập">
                            </div>
                        </div>
                    </div>

                    <div class="col_g l-12_g m-12_g">
                        <div class="add-form__group add-form__item-position">
                            <label>Ngày nhập:</label>
                            <div class="add-form__item">
                                <input type="date" class="add-form__input add-form__input-number" id="ngay-nhap" name="ngay-nhap"  required data-parsley-required-message="Vui lòng chọn ngày nhập!">
                            </div>
                        </div>
                    </div>

                    <div class="col_g l-12_g m-12_g">
                        <div class="add-form__group add-form__item-position">
                            <label>Nhà cung cấp:</label>
                            <div class="add-form__item">
                                <select class="add-form__input add-form__select" id="nha-cung-cap" name="nha-cung-cap"  required data-parsley-required-message="Vui lòng chọn nhà cung cấp!">
                                    <option value="">Tùy chọn nhà cung cấp </option>
                                    @foreach($nhaCungCap as $nCC)
                                    <option value="{{$nCC['id']}}">{{$nCC['id']}} - {{$nCC['ten_ncc']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Nhập nước hoa -->
                    <div class="add-form__container-product-perfume">
                        <div class="row_g row_g-perfume-0">
                            <div class="col_g l-12_g m-12_g">
                                <div class="add-form__group add-form__item-position">
                                    <label style="width:80px">Nước hoa:</label>
                                    <div class="add-form__item">
                                        <select class="add-form__input add-form__select" id="chon-nuoc-hoa-0" name="chon-nuoc-hoa"  required data-parsley-required-message="Vui lòng chọn nước hoa!">
                                            <option value="">Tùy chọn nước hoa</option>
                                            @foreach($nuocHoa as $nH)
                                            <option value="{{$nH['id']}}">{{$nH['id']}} - {{$nH['ten_nuoc_hoa']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col_g c-o-2_g m-o-2_g l-4_g m-4_g">
                                <div class="add-form__group add-form__item-position">
                                    <label>Giá nhập:</label>
                                    <div class="add-form__item">
                                        <input type="number" class="add-form__input add-form__input-number" id="gia-nhap-0" name="gia-nhap" placeholder="Giá tiền nhập"  required data-parsley-required-message="Vui lòng nhập giá!">
                                    </div>
                                </div>
                            </div>

                            <div class="col_g l-3_g m-3_g">
                                <div class="add-form__group add-form__item-position">
                                    <label>Số lượng:</label>
                                    <div class="add-form__item">
                                        <input type="number" class="add-form__input add-form__input-number" id="so-luong-nhap-0" name="so-luong-nhap" placeholder="Số lượng"  required data-parsley-required-message="Vui lòng nhập số lượng!">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- End nhập nước hoa -->

                    <div class="col_g l-12_g m-12_g">
                        <div class="add-form__group add-form__item-position add-form__btn-add-item">
                            <a id="button_add-item-product" class="add-account__btn add__perfume-item"><i class="fas fa-plus-circle add-account__icon"></i> Thêm</a>
                        </div>
                    </div>

                </div>

                <div class="row_g row__add-product">
                    <div class="col_g l_12_g">
                        <div class="add-form__controls add-form__controls-add-product">
                            <a href="" type="button" class="btn add-form__controls-back btn--normal btn--des-account">HỦY</a>
                            <button type="submit" id="luu_phieu_nhap" class="btn btn--primary btn--add-product">LƯU</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('page-js')
<script>

    // Thêm item nước hoa
    var index = 1;
    $('.add__perfume-item').on('click', function() {
        $('.add-form__container-product-perfume').append(`<div class="row_g row_g-perfume-${index}" style=" margin-top: 18px;">
                        <div class="col_g l-12_g m-12_g">
                            <div class="add-form__group add-form__item-position">
                                <label>Nước hoa:</label>
                                <div class="add-form__item">
                                    <select class="add-form__input add-form__select" id="chon-nuoc-hoa-${index}" name="chon-nuoc-hoa" required data-parsley-required-message="Vui lòng chọn nuoc hoa!">>
                                        <option value="">Tùy chọn nước hoa</option>
                                            @foreach($nuocHoa as $nH)
                                            <option value="{{$nH['id']}}">{{$nH['id']}} - {{$nH['ten_nuoc_hoa']}}</option>
                                            @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col_g c-o-2_g m-o-2_g l-4_g m-4_g">
                            <div class="add-form__group add-form__item-position">
                                <label>Giá nhập:</label>
                                <div class="add-form__item">
                                    <input type="number" class="add-form__input add-form__input-number" id="gia-nhap-${index}" name="gia-nhap" placeholder="Giá tiền nhập" required data-parsley-required-message="Vui lòng nhập giá!">
                                </div>
                            </div>
                        </div>

                        <div class="col_g l-3_g m-3_g">
                            <div class="add-form__group add-form__item-position">
                                <label>Số lượng:</label>
                                <div class="add-form__item">
                                    <input type="number" class="add-form__input add-form__input-number" id="so-luong-nhap-${index}" name="so-luong-nhap" placeholder="Số lượng" required data-parsley-required-message="Vui lòng nhập số lượng!">
                                </div>
                            </div>
                        </div>

                        <div class="col_g l-1_g m-1_g">
                            <a onclick="trash__perfume_item(${index})" class="trash__perfume-item" id="trash__perfume-item-${index}"><i class="fas fa-trash-alt icon"></i></a>
                        </div>
                    </div>`);
        index++;
    });

    // Xóa item nước hoa
    function trash__perfume_item(index2) {
        $(`.row_g-perfume-${index2}`).remove();
    }

    // tính tống số lượng và tổng tiền.
    $(document).bind('mouseover', function() {
        let dem_gia_nhap = $('input[name="gia-nhap"]');  
        let tong_so_luong = 0;
        let tong_tien_1_sp = 0
        let tong_tien = 0
            for(let i = 0; i<dem_gia_nhap.length; i++) {
                let dem_chon_nuoc_hoa = $('select[name="chon-nuoc-hoa"]')[i];
                let dem_so_luong_nhap = $('input[name="so-luong-nhap"]')[i];

               if(dem_gia_nhap[i] != 0 && dem_so_luong_nhap !=0) {
                    tong_so_luong += Number(dem_so_luong_nhap.value);
                    tong_tien_1_sp = Number(dem_so_luong_nhap.value) * Number(dem_gia_nhap[i].value);
                    tong_tien += tong_tien_1_sp;
                }
            }

            $('#tong-so-luong-nhap').val(tong_so_luong);
            $('#tong-tien-nhap').val(tong_tien);
    });

    $('#them-phieu-nhap').submit(function(e) {
        e.preventDefault();
        if($(this).parsley().isValid()) {
            var form = $(this);
            var url = form.attr('action');
            var array_value_item = new Array();

            let tong_so_luong = 0;
            let tong_tien_1_sp = 0
            let tong_tien = 0

            let dem_gia_nhap = $('input[name="gia-nhap"]');   
            for(let i = 0; i<dem_gia_nhap.length; i++) {
                let dem_chon_nuoc_hoa = $('select[name="chon-nuoc-hoa"]')[i];
                let dem_so_luong_nhap = $('input[name="so-luong-nhap"]')[i];
                
                array_value_item.push([
                    Number(dem_chon_nuoc_hoa.value), 
                    Number(dem_gia_nhap[i].value), 
                    Number(dem_so_luong_nhap.value)
                ]);
            }

            var formData = new FormData($(this)[0]);
            for(let i = 0; i < array_value_item.length; i++) {
                formData.append('data_value_item[]', array_value_item[i]);
            }
             formData.append('tong_so_luong_nhap', $('#tong-so-luong-nhap').val());
             formData.append('ngay_nhap', $('#ngay-nhap').val());
             formData.append('tong_tien_nhap', $('#tong-tien-nhap').val());
             formData.append('nha_cung_cap_id', $('#nha-cung-cap').val());

            $.ajax({
                type: 'POST',
                url :   url,
                data: formData,
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    if(data.status == 'success') {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: data.message,
                            showConfirmButton: false,
                            timer: 1500
                        })
                        window.setTimeout(function(){
                            window.location.replace("{{route('quanly.ql-phieu-nhap')}}");
                        },1500);
                    } else {
                        $('.grid_g').before('<div class="alert alert-danger noti-alert-danger" role="alert" style="font-size: 1.5rem;">' + data.message + '</div>');
                        window.setTimeout(function() {
                            $('.alert.alert-danger.noti-alert-danger').remove();
                        }, 5000);
                    }
                },
                error: function(response) {
                    $.each(response.responseJSON.errors, function(field_name, error) {
                        $('.add-form__header.add-form__add-account--center').before('<div class="alert alert-danger noti-alert-danger" role="alert" style="font-size: 1.5rem;">' + error + '</div>');
                    }),
                    window.setTimeout(function() {
                            $('.alert.alert-danger.noti-alert-danger').remove();
                    }, 2500);
                }
            });
        }
       
        
    });
</script>
@endsection