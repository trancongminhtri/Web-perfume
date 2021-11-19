@extends('layout-user')
@section('title')
@endsection
@section('content')
<!-- Start Container -->
<div class="app__container app__category">
    <div class="grid_g wide_g">
        <div class="row_g app__content" style="margin-bottom: 8px;">
            <div class="col_g l-8_g m-8_g c-12_g">
                <div class="row_g sm-gutters" id="them-blog">
                    <div class="col_g l-12_g m-12_g c-12_g">
                        <div class="info__title">
                            <span>Bài Viết Mới</span>
                        </div>
                    </div>
                    <div class="row_g sm-gutters" id="them-blog">
                            <!-- Blog mới nhất -->
                            @include('blog.blog')
                    </div>
                </div>
            </div>
            <div class="col_g l-4_g m-4_g c-12_g">
                <div class="row_g sm-gutters">
                    <div class="col_g l-12_g m-12_g c-12_g">
                        <div class="info__title">
                            <span>Đề Xuất</span>
                        </div>
                    </div>
                    @foreach($dsBlogRandom as $blog)
                    <div class="col_g l-12_g m-12_g">
                        <a href="{{route('khachhang.trang-chi-tiet-blog', [Str::slug($blog['tieu_de'], '-'), $blog['id']])}}" class="post__item">
                            <div class="post__img">
                                <img src="../{{$blog->duong_dan}}" alt="blog" />
                            </div>
                            <div class="post__content">
                                {{$blog['tieu_de']}}
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Container -->
@endsection
@section('page-js')
<!-- Xem thêm blog -->
<script>
    $(document).ready(function() {
        $(document).on('click', '#xem_them_blog', function(e) {
            e.preventDefault();
            var url = $(this).data('id-blog');
            var last_id = $(this).data('id-last');
            $.ajax({
                type: 'POST',
                url: url,
                data: {
                    last_id: last_id,
                },
                success: function(data) {
                    $('#xem_them_blog').parent().remove();
                    $('#them-blog').append(data);
                }
            });
        });
    });
</script>
@endsection