@extends('layout-user')
@section('title')
@endsection
@section('content')
<!-- ManificPopup CSS -->
<link rel="stylesheet" href="{{asset('./assets/magnificPopup/dist/magnific-popup.css')}}">

<!-- Start Container -->
<div class="app-container__detail ">
    <div class="grid_g wide_g2">
        <div class="row_g ">
            <div class="col_g l-12_g m-12_g c-12_g">
                <div class="breadcrumb">
                    <ul class="breadcrumb__list">
                        <li class="breadcrumb__item">
                            <a href="{{route('nguoidung.trang-chu-nguoi-dung')}}" class="breadcrumb__link">Trang chủ</a>
                        </li>
                        <li class="breadcrumb__item">
                            <a href="" class="breadcrumb__link breadcrumb__link-active">{{$nuocHoa['ten_nuoc_hoa']}}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="grid_g wide_g2">
        <!-- Thông tin cơ bản nước hoa -->
        @include('chi-tiet-nuoc-hoa.thong-tin-nuoc-hoa')

        <div class="row_g row_g-background row_g-gutters">
            <!-- Bài viết về nước hoa -->
            @include('chi-tiet-nuoc-hoa.bai-viet')

            <!-- Nhận xét đánh giá nước hoa -->
            <div class="col_g l-6_g m-6_g c-12_g">
                <div class="perfume-rating-comment" id="giao-dien-danh-gia">
                        @include('chi-tiet-nuoc-hoa.nhan-xet-danh-gia')
                </div>
            </div>

        </div>
        <!-- Cùng thương hiệu -->
        @include('chi-tiet-nuoc-hoa.san-pham-lien-quan')
    </div>
    <div class="modal" id="modal-reviews">
        <!-- .modal để chiếm hết màn hình -->
        <div onclick="reviewsBack()" class="modal__overlay" id="modal__overlay-reviews">
            <!-- modal__overlay tạo lớp phủ mờ  -->
        </div>
        <div class="modal__body">
            <!-- modal__body để canh chỉnh kích thước, vị trí khung chứa content  -->

            <!-- Reviews form -->
            <div class="auth-form form-reviews" id="reviews-form">
                <div class="auth-form__container">
                    <form action="{{route('nhan-xet-danh-gia', $nuocHoa->id)}}" id="nhan-xet-danh-gia" method="post">
                        @csrf
                        <div class="auth-form__header form-reviews__header">
                            <h3 class="auth-form__haeding form-reviews__heading">Đánh giá sản phẩm</h3>
                        </div>

                        <div class="form-reviews__rating">
                            <input hidden type="radio" class="reviews__rating-input" name="rate" id="rate-5" data-id-rating="5">
                            <label for="rate-5" class="fas fa-star icon5"></label>

                            <input hidden type="radio" class="reviews__rating-input" name="rate" id="rate-4" data-id-rating="4">
                            <label for="rate-4" class="fas fa-star icon4"></label>

                            <input hidden type="radio" class="reviews__rating-input" name="rate" id="rate-3" data-id-rating="3">
                            <label for="rate-3" class="fas fa-star icon3"></label>

                            <input hidden type="radio" class="reviews__rating-input" name="rate" id="rate-2" data-id-rating="2">
                            <label for="rate-2" class="fas fa-star icon2"></label>

                            <input hidden type="radio" class="reviews__rating-input" name="rate" id="rate-1" data-id-rating="1">
                            <label for="rate-1" class="fas fa-star icon1"></label>
                        </div>

                        <div class="share-feelings">
                            <div class="share-feelings__title">Chia sẻ cảm nhận</div>
                            <textarea class="share-feelings__content" aria-required="true" placeholder="Hãy chia sẻ cảm nhận của bạn về sản phẩm này"></textarea>
                        </div>

                        <div class="form-btn">
                            <a onclick="reviewsBack()" class="btn btn-reviews__back" style="color: #555;">Trở lại</a>
                            <button class="btn btn-reviews__share" style="color: #fff;">Chia sẻ</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Container -->
@endsection
@section('page-js')
<script>
    $('#nhan-xet-danh-gia').submit(function(e) {
        e.preventDefault();
        let check = '';
        let comment = '';
        $('input[class="reviews__rating-input"]:checked').each(function() {
            check = $(this).data("id-rating");
        });

        comment = $('.share-feelings__content').val();

        var form = $(this);
        var url = form.attr('action');
        $.ajax({
            type: "POST",
            url: url,
            data: {
                check: check,
                comment: comment,
            },
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
                    reviewsBack();
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: data.message,
                        showConfirmButton: false,
                        timer: 1500
                    });
                    $('#giao-dien-danh-gia').empty();
                    $('#giao-dien-danh-gia').html(data.giao_dien_binh_luan);

                    $('#luot-danh-gia').empty();
                    $('#luot-danh-gia').html(data.luot_danh_gia);
                }
            },
        });
    });
</script>

<script type="text/javascript">
    var modalReviews = document.getElementById("modal-reviews");
    var modalOverlayReviews = document.getElementById("modal__overlay-reviews");
    var fomrReviews = document.getElementById("reviews-form");
    var reviewRatingBtn = document.querySelectorAll('input[type="radio"]');
    var reviewComment = document.querySelector('.share-feelings .share-feelings__content');

    function reviewsForm() {
        modalReviews.style.display = "flex";
        modalOverlayReviews.style.display = "block";
        fomrReviews.style.display = "block";
        reviewComment.focus();
    }

    function reviewsBack() {
        modalReviews.style.display = "none";
        modalOverlayReviews.style.display = "none";
        fomrReviews.style.display = "none";
        reviewRatingBtn.forEach(function (btnRating) {
           btnRating.checked = false;
        });
        reviewComment.value = null;
    }
</script>

<!-- Slider img perfume -->
<script type="text/javascript">
    let imgAvt = document.querySelectorAll(".perfume-slider__img");
    let btnNavAvt = document.querySelectorAll(".perfume-slider__navigation-btn");

    let curentAvt = 1;

    // Manual Navigation
    let manualNavAvt = function(manual) {
        imgAvt.forEach((slides) => {
            slides.classList.remove("active");

            btnNavAvt.forEach((btn) => {
                btn.classList.remove("active");
            });
        });

        imgAvt[manual].classList.add("active");
        btnNavAvt[manual].classList.add("active");
    }

    btnNavAvt.forEach((btn, i) => {
        btn.addEventListener("click", () => {
            manualNavAvt(i);
            curentAvt = i;
        });
    });
</script>

<!-- ManificPopup JS -->
<script type="text/javascript" src="{{asset('./assets/magnificPopup/dist/jquery.magnific-popup.min.js')}}"></script>

<!-- ManificPopup custom -->
<script>
    $(document).ready(function() {
        $('.gallerys').magnificPopup({
            type: 'image',
            delegate: 'a',
            gallery: {
                enabled: true
            } 
        });
    });
</script>
@endsection