<!DOCTYPE html>
<html lang="en">

<head>
    @include('includes.header')

    @include('includes.link')
</head>

<body>
    <div class="wapper">
        <!-- Start Container -->
        <div class="app__container app-container__not-found">
            <div class="grid_g wide_g">
                <div class="row_g sm-gutters app__content">
                    <div class="col_g l-12_g m-12_g c-12_g">
                        <div class="not-found-404">
                            <img src="{{asset('assets/img/404-page.png')}}" alt="" class="img-404-not-found" />
                        </div>
                    </div>
                    <div class="col_g l-12_g m-12_g c-12_g">
                        <div class="page-index">
                            <a href="/" class="page-index__btn">TRANG CHỦ</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>

</html>