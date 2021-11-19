@extends('admin.layout-admin')
@section('title')
@endsection
@section('content')
<!-- Loading -->
<div class="loading"></div>
<div class="content-admin">
    <div class="acount">
        <!-- Search -->
        <div class="search">
            <label for="" class="search__title">Tìm kiếm</label>
            <div class="search-form">
                <form action="{{route('quanly.ql-slideshow')}}" method="GET">
                    <div class="search-form-left">
                        <input type="text" name="ten_slideshow" class="search__name search__name-slideshow" placeholder="Nhập tên slideshow" value="{{isset($inputSearch['ten_slideshow']) ? $inputSearch['ten_slideshow'] : null}}">
                        <button class="search__btn"><i class="fas fa-search filter__icon-search"></i>Tìm kiếm</button>
                        <a href="{{route('quanly.ql-slideshow')}}" class="filter__btn"><i class="fas fa-redo-alt filter__icon"></i></a>
                    </div>
                </form>
                <div class="search-form-right">
                    <a href="{{route('quanly.them-slideshow')}}" class="add-account__btn"><i class="fas fa-plus-circle add-account__icon"></i> Thêm mới</a>
                </div>
            </div>
        </div>
        
        <div id="bang-slideshow">
            @include('admin.slideshow.bang-slideshow')
        </div>

        <!-- Change page -->
        @if(count($dsSlideShow) > 0)
        <div class="change-page">
            @if($dsSlideShow->onFirstPage())
            <i class="fas fa-arrow-left change-page__icon"></i>
            @else
            <a class="change-page__link" href="{{$dsSlideShow->previousPageUrl()}}"><i class="fas fa-arrow-left change-page__icon"></i></a>
            @endif
            <span class="change-page__num">Trang {{$dsSlideShow->currentPage()}}</span>
            @if($dsSlideShow->hasMorePages())
            <a class="change-page__link" href="{{$dsSlideShow->nextPageUrl()}}"><i class="fas fa-arrow-right change-page__icon"></i></a>
            @else
            <i class="fas fa-arrow-right change-page__icon"></i>
            @endif
        </div>
        @endif
    </div>
</div>
@endsection
@section('page-js')
<!-- Xóa slideshow -->
<script>
    function xoaSlideShow(event) {
        event.preventDefault();
        let urlRequest = $(this).data('url');
        let that = $(this);
        Swal.fire({
            title: 'Bạn có chắc muốn xóa slideshow ?',
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
                            $('#bang-slideshow').empty();
                            $('#bang-slideshow').html(data.giao_dien_bang);
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
        $(document).on('click', '.xoa-slideshow', xoaSlideShow);
    });
</script>
@endsection