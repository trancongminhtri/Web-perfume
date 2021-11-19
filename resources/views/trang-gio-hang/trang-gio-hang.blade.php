@extends('layout-user')
@section('title')
@endsection
@section('content')
<!-- Start Container -->
<div class="app-container__cart">
    <div class="grid_g wide_g2">
        <div class="row_g">
            <div class="perfume-cart">
                <div class="perfume-cart__name">Giỏ hàng</div>
                <div class="perfume-cart__contents">
                    <!-- Nội dung -->
                    <div id="delete-list-cart">
                        @include('trang-gio-hang.danh-sach-gio-hang')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Container -->
@endsection
@section('page-js')
<!-- Xóa sản phẩm khỏi danh sach giỏ hàng -->
<script>
    function deleteItemListCart(id){
        $.ajax({
            url: '/Delete-Item-List-Cart/' + id,
            type: 'GET',
        }).done(function(res){
            RenderListCart(res);
            tangSanPham();
            giamSanPham();
            alertify.notify('Đã Xóa Sản Phẩm Thành Công!', 'success');
        });
    }
</script>

<script>
    function RenderListCart(res){
        $('#delete-list-cart').empty();
        $('#delete-list-cart').html(res['danh-sach-gio-hang']);
        $('#change-item-cart').empty();
        $('#change-item-cart').html(res['gio-hang']);
       
    }
</script>

<!-- Tăng giảm số lượng sản phẩm trong danh sách giỏ hàng -->
<script>
    function updateItemListCart(id, so_luong){
        $.ajax({
            url: '/Update-Item-List-Cart/' + id + '/' + so_luong,
            type: 'GET',
        }).done(function(res){
            RenderListCart(res);
            tangSanPham();
            giamSanPham();
        });
    }
</script>

<script>
    tangSanPham();
    let valueCount;

    function tangSanPham() {
        let btnPlus = document.getElementsByClassName('quantity__plus');
        for (let i = 0; i < btnPlus.length; i++) {
            btnPlus[i].addEventListener('click', function() {
                // Lấy giá trị input
                valueCount = document.getElementsByClassName('quantity_num')[i];
                // Tăng giá trị lên 1
                valueCount.value++;
                updateItemListCart($(this).data('id-quantity'),  valueCount.value);
                if (valueCount.value > 1) {
                    document.getElementsByClassName("quantity__minus")[i].removeAttribute("disabled");
                    document.getElementsByClassName("quantity__minus")[i].classList.remove("disabled");
                }
            });
        }
    }

    giamSanPham();

    function giamSanPham() {
        let btnMinus = document.getElementsByClassName('quantity__minus');
        for (let i = 0; i < btnMinus.length; i++) {
            btnMinus[i].addEventListener('click', function() {
                // Lấy giá trị input
                valueCount = document.getElementsByClassName('quantity_num')[i];

                // Giảm giá trị lên 1
                valueCount.value--;
                updateItemListCart($(this).data('id-quantity'),  valueCount.value);
                if (valueCount.value == 1) {
                    document.getElementsByClassName("quantity__minus")[i].setAttribute("disabled", "disabled");
                }
            });
        }
    }
</script>
@endsection