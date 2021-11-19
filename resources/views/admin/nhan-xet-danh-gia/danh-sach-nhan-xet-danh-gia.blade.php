@extends('admin.layout-admin')
@section('title')
@endsection
@section('content')
<!-- End Slider -->
<div class="content-admin">
    <div class="acount">
        <!-- Search -->
        <div class="search search__rating">
            <label for="" class="search__title">Tìm kiếm</label>
            <div class="search-form">
                <form action="{{route('quanly.ql-nhan-xet-danh-gia')}}" method="GET">
                    <div class="search-form-left search__rating-form">
                        <div class="filter__rating-up">
                            <input type="text" class="search__name search__name-user" placeholder="Nhập email người dùng" name="email_nguoi_dung" value="{{isset($inputSearch['email_nguoi_dung']) ? $inputSearch['email_nguoi_dung'] : null}}">
                        </div>
                        <div class="filter__rating-down">
                            <input type="text" class="search__name search__name-perfume" placeholder="Nhập tên nước hoa" name="ten_nuoc_hoa" value="{{isset($inputSearch['ten_nuoc_hoa']) ? $inputSearch['ten_nuoc_hoa'] : null}}">
                            <select class="filter-position__list point__rating-select" name="diem_danh_gia" value="{{isset($inputSearch['diem_danh_gia']) ? $inputSearch['diem_danh_gia'] : null}}">
                                <option value="">Điểm đánh giá</option>
                                <option value="5">5</option>
                                <option value="4">4 </option>
                                <option value="3">3</option>
                                <option value="2">2</option>
                                <option value="1">1</option>
                            </select>
                            <button class="search__btn search__btn-rating"><i class="fas fa-search filter__icon-search"></i>Tìm kiếm</button>
                            <a href="{{route('quanly.ql-nhan-xet-danh-gia')}}" class="filter__btn search__btn-rating"><i class="fas fa-redo-alt filter__icon"></i></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- Table list account -->
        <div id="bang-danh-gia">
            @include('admin.nhan-xet-danh-gia.bang-danh-gia')
        </div>

        <!-- Change page -->
        @if(count($dsBinhLuan) > 0)
        <div class="change-page">
            @if($dsBinhLuan->onFirstPage())
            <i class="fas fa-arrow-left change-page__icon"></i>
            @else
            <a class="change-page__link" href="{{$dsBinhLuan->previousPageUrl()}}"><i class="fas fa-arrow-left change-page__icon"></i></a>
            @endif
            <span class="change-page__num">Trang {{$dsBinhLuan->currentPage()}}</span>
            @if($dsBinhLuan->hasMorePages())
            <a class="change-page__link" href="{{$dsBinhLuan->nextPageUrl()}}"><i class="fas fa-arrow-right change-page__icon"></i></a>
            @else
            <i class="fas fa-arrow-right change-page__icon"></i>
            @endif
        </div>
        @endif
    </div>
</div>
@endsection
@section('page-js')
<!-- Xóa hương thơm -->
<script>
    function xoaDanhGia(event) {
        event.preventDefault();
        let urlRequest = $(this).data('url');
        let that = $(this);
        Swal.fire({
            title: 'Bạn có chắc muốn xóa nhận xét và đánh giá ?',
            icon: 'warning',
            showCancelButton: true,
            cancelButtonColor: '#d33',
            confirmButtonColor: '#3085d6',
            cancelButtonText: 'Hủy',
            confirmButtonText: 'Xóa'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'DELETE',
                    url: urlRequest,
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(data) {
                        if (data.status == 'success') {
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: data.message,
                                showConfirmButton: false,
                                timer: 1500
                            })
                            $('#bang-danh-gia').empty();
                            $('#bang-danh-gia').html(data.giao_dien_bang);
                        } else {
                            Swal.fire({
                                position: 'center',
                                icon: 'error',
                                title: data.message,
                                showConfirmButton: false,
                                timer: 1500
                            })
                        }
                    },
                });
            }
        })
    }

    $(function() {
        $(document).on('click', '.xoa-danh-gia', xoaDanhGia);
    });
</script>
@endsection