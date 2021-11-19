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
            <form action="{{route('quanly.ql-blog')}}" method="GET">
                <div class="search-form">
                    <div class="search-form-left">
                        <input type="text" class="search__name search__name-code" placeholder="Nhập tiêu đề" name="tieu_de_blog" value="{{isset($inputSearch['tieu_de_blog']) ? $inputSearch['tieu_de_blog'] : null}}">
                        <div class="filter-position">
                            <button class="search__btn"><i class="fas fa-search filter__icon-search"></i>Tìm kiếm</button>
                            <a href="{{route('quanly.ql-blog')}}" class="filter__btn"><i class="fas fa-redo-alt filter__icon"></i></a>
                        </div>
                    </div>
                    <div class="search-form-right">
                        <a href="{{route('quanly.them-trang-blog')}}" class="add-account__btn"><i class="fas fa-plus-circle add-account__icon"></i> Thêm mới</a>
                    </div>
                </div>
            </form>
        </div>
        <!-- Table list account -->
        <div id="bang-blog">
            @include('admin.blog.bang-blog')
        </div>
        <!-- Change page -->
        @if(count($dsBlog) > 0)
        <div class="change-page">
            @if($dsBlog->onFirstPage())
            <i class="fas fa-arrow-left change-page__icon"></i>
            @else
            <a class="change-page__link" href="{{$dsBlog->previousPageUrl()}}"><i class="fas fa-arrow-left change-page__icon"></i></a>
            @endif
            <span class="change-page__num">Trang {{$dsBlog->currentPage()}}</span>
            @if($dsBlog->hasMorePages())
            <a class="change-page__link" href="{{$dsBlog->nextPageUrl()}}"><i class="fas fa-arrow-right change-page__icon"></i></a>
            @else
            <i class="fas fa-arrow-right change-page__icon"></i>
            @endif
        </div>
        @endif
    </div>
</div>
@endsection
@section('page-js')
<!-- Xóa blog -->
<script>
    function xoaBlog(e) {
        e.preventDefault();
        let urlRequest = $(this).data('url');
        let that = $(this);
        Swal.fire({
            title: 'Bạn có chắc muốn xóa trang tĩnh?',
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
                            });
                            $('#bang-blog').empty();
                            $('#bang-blog').html(data.giao_dien_bang);
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
        $(document).on('click', '.xoa__blog', xoaBlog);
    });
</script>
@endsection