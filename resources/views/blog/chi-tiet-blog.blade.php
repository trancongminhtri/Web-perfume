@extends('layout-user')
@section('title')
@endsection
@section('content')
<!-- Start Container -->
<style>
   @media (max-width: 700px) {
      p > img {
         width: 100%;
         height: 100%;
      }
   }
</style>
<div class="app__container app__category">
   <div class="grid_g wide_g">
      <div class="row_g app__content">
         <div class="col_g l-12_g m-12_g c-12_g">
            <div class="breadcrumb hide-on-mobile" style="background-color: #fff;">
               <ul class="breadcrumb__list">
                  <li class="breadcrumb__item">
                     <a href="/" class="breadcrumb__link breadcrumb__link-index">Trang chủ</a>
                  </li>
                  <li class="breadcrumb__item">
                     <a href="{{route('khachhang.trang-danh-sach-blog')}}" class="breadcrumb__link breadcrumb__link-blog">Bài viết</a>
                  </li>
                  <li class="breadcrumb__item ">
                     <a class="breadcrumb__link breadcrumb__link-active " style="text-transform: capitalize;">{{$searchIdBlog['tieu_de']}}</a>
                  </li>
                  
               </ul>
            </div>
         </div>
         <div class="col_g l-12_g m-12_g c-12_g">
            <div class="blog__detail">
               <div class="blog-detail__date-create">
                  {{ \Carbon\Carbon::parse($searchIdBlog['updated_at'])->format('d-m-Y H:i:s')}}
               </div>
               <div class="blog-detail__title">
                  <span>{{$searchIdBlog['tieu_de']}}</span>
               </div>
               <div class="blog-detail__content">
                  <span>{!!$searchIdBlog->noi_dung!!}</span>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- End Container -->
@endsection
@section('page-js')
@endsection