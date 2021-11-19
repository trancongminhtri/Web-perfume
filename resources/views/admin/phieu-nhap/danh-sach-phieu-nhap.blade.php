@extends('admin.layout-admin')
@section('title')
@endsection
@section('content')
<!-- End Slider -->
<div class="content-admin">
    <div class="acount">
        <!-- Search -->
        <div class="search">
            <label for="" class="search__title">Tìm kiếm</label>
            <div class="search-form">
                <form action="{{route('quanly.ql-phieu-nhap')}}" method="GET">
                    <div class="search-form-left">
                        <!-- <input type="text" class="search__name search__name-coupon" placeholder="Nhập tên nước hoa" name="ten_nuoc_hoa" value="{{isset($inputSearch['ten_nuoc_hoa']) ? $inputSearch['ten_nuoc_hoa'] : null}}"> -->
                        <input type="date" class="filter__coupon-date" name="from_date">
                        <button class="search__btn" style="margin-right: 2px;"><i class="fas fa-filter filter__icon-search"></i>Lọc</button>
                        <a href="{{route('quanly.ql-phieu-nhap')}}" class="filter__btn" ><i class="fas fa-redo-alt filter__icon"></i></a>
                    </div>
                </form>
                <div class="search-form-right">
                    <a href="{{route('quanly.trang-them-phieu-nhap')}}" class="add-account__btn"><i class="fas fa-plus-circle add-account__icon"></i> Thêm mới</a>
                </div>
            </div>
        </div>
        <!-- Table list account -->
        <div id="bang-phieu-nhap">
            @include('admin.phieu-nhap.bang-phieu-nhap')
        </div>

        <!-- Change page -->
        @if(count($dsPhieuNhap) > 0)
        <div class="change-page">
            @if($dsPhieuNhap->onFirstPage())
            <i class="fas fa-arrow-left change-page__icon"></i>
            @else
            <a class="change-page__link" href="{{$dsPhieuNhap->previousPageUrl()}}"><i class="fas fa-arrow-left change-page__icon"></i></a>
            @endif
            <span class="change-page__num">Trang {{$dsPhieuNhap->currentPage()}}</span>
            @if($dsPhieuNhap->hasMorePages())
            <a class="change-page__link" href="{{$dsPhieuNhap->nextPageUrl()}}"><i class="fas fa-arrow-right change-page__icon"></i></a>
            @else
            <i class="fas fa-arrow-right change-page__icon"></i>
            @endif
        </div>
        @endif
    </div>
</div>
@endsection
@section('page-js')
<script type="text/javascript">
    var modalAddEdit = document.getElementById("modal-add-edit"); //id modal
    var formAddCoupon = document.getElementById("add-form__coupon"); //id form nội dung
    var formSeenCoupon = document.getElementById("seen-form__coupon"); //id form nội dung

    function AddCoupon() {
        modalAddEdit.style.display = "flex";
        formAddCoupon.style.display = "block";
        formSeenCoupon.style.display = "none";
    }

    function SeenCoupon() {
        modalAddEdit.style.display = "flex";
        formSeenCoupon.style.display = "block";
        formAddCoupon.style.display = "none";
    }

    function backAddSeenCoupon() {
        modalAddEdit.style.display = "none";
        formAddCoupon.style.display = "none";
        formSeenCoupon.style.display = "none";
    }

    function modalOverlayAddEdit() {
        modalAddEdit.style.display = "none";
        formAddCoupon.style.display = "none";
        formSeenCoupon.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == modalAddEdit) {
            modalAddEdit.style.display = "none";
            formAddCoupon.style.display = "none";
            formSeenCoupon.style.display = "none";
        }
    }
</script>

<!-- Thêm phiếu nhập -->
<script>
    $('#them-phieu-nhap').submit(function(e) {
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
                        backAddSeenCoupon();
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: data.message,
                            showConfirmButton: false,
                            timer: 1500
                        })
                        $('#bang-phieu-nhap').empty();
                        $('#bang-phieu-nhap').html(data.giao_dien_bang);
                        setNullValue();
                    }
                },
                error: function(response) {
                    $.each(response.responseJSON.errors, function(field_name, errors) {
                            $('#them-phieu-nhap').before('<div class="alert alert-danger noti-alert-danger" role="alert" style="font-size: 1.5rem;">' + errors + '</div>');
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