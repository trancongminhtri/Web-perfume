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
                <form action="{{route('quanly.ql-khuyen-mai')}}" method="GET">
                    <div class="search-form-left">
                        <input type="text" class="search__name search__name-trademark" name="ten_khuyen_mai" placeholder="Nhập tên khuyến mãi" value="{{isset($inputSearch['ten_khuyen_mai']) ? $inputSearch['ten_khuyen_mai'] : null}}">

                        <button class="search__btn"><i class="fas fa-search filter__icon-search"></i>Tìm kiếm</button>
                        <a href="{{route('quanly.ql-khuyen-mai')}}" class="filter__btn"><i class="fas fa-redo-alt filter__icon"></i></a>
                    </div>
                </form>
                <div class="search-form-right">
                    <a href="{{route('quanly.them-khuyen-mai')}}" class="add-account__btn"><i class="fas fa-plus-circle add-account__icon"></i> Thêm mới</a>
                </div>
            </div>
        </div>
        <!-- Table list account -->
        <div id="bang-khuyen-mai-id">
            @include('admin.khuyen-mai.bang-khuyen-mai')
        </div>

        <!-- Change page -->
        @if(count($dsKhuyenMai) > 0)
        <div class="change-page">
            @if($dsKhuyenMai->onFirstPage())
            <i class="fas fa-arrow-left change-page__icon"></i>
            @else
            <a class="change-page__link" href="{{$dsKhuyenMai->previousPageUrl()}}"><i class="fas fa-arrow-left change-page__icon"></i></a>
            @endif
            <span class="change-page__num">Trang {{$dsKhuyenMai->currentPage()}}</span>
            @if($dsKhuyenMai->hasMorePages())
            <a class="change-page__link" href="{{$dsKhuyenMai->nextPageUrl()}}"><i class="fas fa-arrow-right change-page__icon"></i></a>
            @else
            <i class="fas fa-arrow-right change-page__icon"></i>
            @endif
        </div>
        @endif
    </div>
</div>
@endsection
@section('page-js')
<!-- Xóa khuyến mãi -->
<script>
    function xoaKhuyenMai(event) {
        event.preventDefault();
        let urlRequest = $(this).data('url');
        let that = $(this);
        Swal.fire({
            title: 'Bạn có chắc muốn xóa khuyến mãi ?',
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
                            that.parent().parent().remove();
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: data.message,
                                showConfirmButton: false,
                                timer: 1500
                            })
                            $('#bang-khuyen-mai-id').empty();
                            $('#bang-khuyen-mai-id').html(data.giao_dien_bang_khuyen_mai);
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
        $(document).on('click', '.xoa-khuyen-mai', xoaKhuyenMai);
    });
</script>
@endsection