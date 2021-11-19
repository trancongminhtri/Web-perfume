<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest:web')->group(function() {
    Route::name('nguoidung.')->group(function(){
        Route::get('/','UserController@trangChuNguoiDung')->name('trang-chu-nguoi-dung');
        Route::post('/','UserController@dangNhapTaiKhoan')->name('dang-nhap');
        Route::post('/dang-ky','UserController@dangKyTaiKhoan')->name('dang-ky'); 
        Route::get('/xac-nhan-tai-khoan', 'UserController@xacNhanTaiKhoan')->name('xac-nhan-tai-khoan');
        Route::post('/gui-ma-otp','UserController@guiMaOTP')->name('gui-ma-otp');
        Route::post('/nhap-ma-otp', 'UserController@nhapMaOTP')->name('nhap-ma-otp');
    });
});

Route::middleware('auth:web')->group(function() {
    Route::middleware('admin.access:admin')->group(function() {
        Route::name('quanly.')->group(function(){
            Route::get('/quan-ly-tai-khoan','UserController@quanLyTaiKhoan')->name('ql-tai-khoan');
            Route::post('/quan-ly-tai-khoan','UserController@themTaiKhoan')->name('them-tai-khoan'); 
            Route::post('/khoa-tai-khoan/{id}', 'UserController@khoaTaiKhoan')->name('khoa-tai-khoan');
            Route::post('/mo-tai-khoan/{id}', 'UserController@moTaiKhoan')->name('mo-tai-khoan');
            Route::get('/cap-nhat-thong-tin', 'UserController@trangCapNhatThongTin')->name('trang-cap-nhat-thong-tin');      
            Route::post('/cap-nhat-thong-tin', 'UserController@capNhatThongTin')->name('cap-nhat-thong-tin');
            Route::get('/thong-tin-tai-khoan/{slug}-us{id}', 'UserController@thongTinTaiKhoan')
                    ->where('slug', '[a-zA-Z0-9-_]+')
                    ->where('id', '[0-9]+')
                    ->name('thong-tin-tai-khoan');      

            Route::get('/quan-ly-nuoc-hoa','NuocHoaController@quanLyNuocHoa')->name('ql-nuoc-hoa');
            Route::get('/them-nuoc-hoa','NuocHoaController@trangThemNuocHoa')->name('trang-them-nuoc-hoa');
            Route::post('/them-nuoc-hoa', 'NuocHoaController@themNuocHoa')->name('them-nuoc-hoa');
            Route::post('/ckeditor/upload', 'NuocHoaController@ckeditorUpload')->name('ckeditor.upload');
            Route::get('/chi-tiet-nuoc-hoa/{slug}-pf{id}', 'NuocHoaController@chiTietNuocHoa')
                    ->where('slug', '[a-zA-Z0-9-_]+')
                    ->where('id', '[0-9]+')
                    ->name('chi-tiet-nuoc-hoa');
            Route::post('/cap-nhat-nuoc-hoa/{id}','NuocHoaController@capNhatNuocHoa')->name('cap-nhat-nuoc-hoa');
            Route::delete('/xoa-nuoc-hoa/{id}', 'NuocHoaController@xoaNuocHoa')->name('xoa-nuoc-hoa');

            Route::get('/quan-ly-huong-thom','HuongThomController@quanLyHuongThom')->name('ql-huong-thom');
            Route::post('/them-huong-thom','HuongThomController@themHuongThom')->name('them-huong-thom');
            Route::get('/chi-tiet-huong-thom/{id}', 'HuongThomController@chiTietHuongThom')->name('chi-tiet-huong-thom');
            Route::post('/cap-nhat-huong-thom/{id}','HuongThomController@capNhatHuongThom')->name('cap-nhat-huong-thom');
            Route::delete('/xoa-huong-thom/{id}', 'HuongThomController@xoaHuongThom')->name('xoa-huong-thom');

            Route::get('/quan-ly-ncc','NhaCungCapController@quanLyNCC')->name('ql-ncc');
            Route::post('/them-ncc','NhaCungCapController@themNCC')->name('them-ncc');
            Route::get('/chi-tiet-ncc/{id}', 'NhaCungCapController@chiTietNCC')->name('chi-tiet-ncc');
            Route::post('/cap-nhat-ncc/{id}','NhaCungCapController@capNhatNCC')->name('cap-nhat-ncc');
            Route::delete('/xoa-ncc/{id}','NhaCungCapController@xoaNCC')->name('xoa-ncc');

            Route::get('/quan-ly-thuong-hieu','ThuongHieuController@quanLyThuongHieu')->name('ql-thuong-hieu');
            Route::post('/them-thuong-hieu','ThuongHieuController@themThuongHieu')->name('them-thuong-hieu');
            Route::get('/chi-tiet-thuong-hieu/{id}', 'ThuongHieuController@chiTietThuongHieu')->name('chi-tiet-thuong-hieu');
            Route::post('/cap-nhat-thuong-hieu/{id}','ThuongHieuController@capNhatThuongHieu')->name('cap-nhat-thuong-hieu');
            Route::delete('/xoa-thuong-hieu/{id}', 'ThuongHieuController@xoaThuongHieu')->name('xoa-thuong-hieu');

            Route::get('/quan-ly-slideshow','SlideShowController@quanLySlideShow')->name('ql-slideshow');
            Route::get('/them-slideshow','SlideShowController@trangThemSlideShow')->name('trang-them-slideshow');
            Route::post('/them-slideshow','SlideShowController@themSlideShow')->name('them-slideshow');
            Route::get('/chi-tiet-slideshow/{slug}-sl{id}', 'SlideShowController@chiTietSlideShow')
                    ->where('slug', '[a-zA-Z0-9-_]+')
                    ->where('id', '[0-9]+')
                    ->name('chi-tiet-slideshow');
            Route::post('/cap-nhat-slideshow/{id}','SlideShowController@capNhatSlideShow')->name('cap-nhat-slideshow');
            Route::delete('/xoa-slideshow/{id}', 'SlideShowController@xoaSlideShow')->name('xoa-slideshow');

            Route::get('/quan-ly-khuyen-mai','KhuyenMaiController@quanLyKhuyenMai')->name('ql-khuyen-mai');
            Route::get('/them-khuyen-mai','KhuyenMaiController@trangThemKhuyenMai')->name('trang-them-khuyen-mai');
            Route::post('/them-khuyen-mai','KhuyenMaiController@themKhuyenMai')->name('them-khuyen-mai');
            Route::get('/chi-tiet-khuyen-mai/{slug}-pr{id}', 'KhuyenMaiController@chiTietKhuyenMai')
                    ->where('slug', '[a-zA-Z0-9-_]+')
                    ->where('id', '[0-9]+')
                    ->name('chi-tiet-khuyen-mai');
            Route::post('/cap-nhat-khuyen-mai/{id}','KhuyenMaiController@capNhatKhuyenMai')->name('cap-nhat-khuyen-mai');
            Route::delete('/xoa-khuyen-mai/{id}', 'KhuyenMaiController@xoaKhuyenMai')->name('xoa-khuyen-mai');

            Route::get('/quan-ly-danh-muc','DanhMucController@quanLyDanhMuc')->name('ql-danh-muc');
            Route::post('/them-danh-muc','DanhMucController@themDanhMuc')->name('them-danh-muc');
            Route::get('/chi-tiet-danh-muc/{id}', 'DanhMucController@chiTietDanhMuc')->name('chi-tiet-danh-muc');
            Route::post('/cap-nhat-danh-muc/{id}','DanhMucController@capNhatDanhMuc')->name('cap-nhat-danh-muc');
            Route::delete('/xoa-danh-muc/{id}', 'DanhMucController@xoaDanhMuc')->name('xoa-danh-muc');

            Route::get('/quan-ly-phieu-nhap','PhieuNhapController@quanLyPhieuNhap')->name('ql-phieu-nhap');
            Route::get('/trang-them-phieu-nhap','PhieuNhapController@trangThemPhieuNhap')->name('trang-them-phieu-nhap');
            Route::post('/them-phieu-nhap','PhieuNhapController@themPhieuNhap')->name('them-phieu-nhap');
            Route::get('/chi-tiet-phieu-nhap/{id}', 'ChiTietPhieuNhapController@chiTietPhieuNhap')->name('chi-tiet-phieu-nhap');

            Route::get('/quan-ly-don-hang', 'DonHangController@quanLyDonHang')->name('ql-don-hang');
            Route::get('/chi-tiet-don-hang/{id}', 'DonHangController@chiTietDonHang')->name('chi-tiet-don-hang');
            Route::post('/cap-nhat-don-hang/{id}','DonHangController@capNhatDonHang')->name('cap-nhat-don-hang');

            Route::get('/bao-cao-thong-ke', 'BaoCaoThongKeController@trangBaoCaoThongKe')->name('bao-cao-thong-ke');

            Route::get('/quan-ly-nhan-xet-danh-gia', 'NhanXetDanhGiaController@quanLyNhanXetDanhGia')->name('ql-nhan-xet-danh-gia');
            Route::delete('/xoa-danh-gia/{id}', 'NhanXetDanhGiaController@xoaNhanXetDanhGia')->name('xoa-danh-gia');

           Route::get('/quan-ly-blog', 'BlogController@quanlyBlog')->name('ql-blog');
           Route::get('/them-blog', 'BlogController@trangThemBlog')->name('them-trang-blog');
           Route::post('/them-blog', 'BlogController@themBlog')->name('them-blog');
           Route::get('/chi-tiet-blog/{slug}-blog{id}', 'BlogController@chiTietBlog')
           ->where('slug', '[a-zA-Z0-9-_]+')
           ->where('id', '[0-9]+')
           ->name('chi-tiet-blog');
           Route::post('/cap-nhat-blog/{id}','BlogController@capNhatBlog')->name('cap-nhat-blog');
           Route::delete('/xoa-blog/{id}', 'BlogController@xoaBlog')->name('xoa-blog');

           Route::get('/phan-trang-thong-ke', 'BaoCaoThongKeController@phanTrangThongKe')->name('phan-trang-thong-ke');

        }); 
    });
    Route::get('/dang-xuat','UserController@dangXuatTaiKhoan')->name('dang-xuat');
    
    Route::get('/trang-thanh-toan', 'CartController@trangThanhToan')->name('trang-thanh-toan');
    Route::post('/trang-thanh-toan-don-hang', 'CartController@thanhToanDonHang')->name('thanh-toan-don-hang');

    Route::get('/ho-so', 'NguoiDungController@thongTinHoSo')->name('thong-tin-ho-so');
    Route::get('/cap-nhat-ho-so', 'NguoiDungController@trangCapNhatHoSo')->name('trang-cap-nhat-ho-so');
    Route::post('/cap-nhat-ho-so', 'NguoiDungController@capNhatHoSo')->name('cap-nhat-ho-so');

    // Nhận xét và đánh giá
    Route::post('/nhan-xet-danh-gia/{id}','TrangChiTietController@nhanXetDanhGia')->name('nhan-xet-danh-gia');

});

Route::name('khachhang.')->group(function(){
    Route::get('/thong-tin-nuoc-hoa/{slug}-pf{id}','TrangChiTietController@trangChiTietNuocHoa')
            ->where('slug', '[a-zA-Z0-9-_]+')
            ->where('id', '[0-9]+')
            ->name('chi-tiet-nuoc-hoa');

    Route::get('/Add-Cart/{id}', 'CartController@AddCart')->name('add-cart');
    Route::get('/Delete-Item-Cart/{id}', 'CartController@DeleteItemCart')->name('delete-item-cart');
    Route::get('/gio-hang', 'CartController@trangGioHang')->name('trang-gio-hang');

    Route::get('/Delete-Item-List-Cart/{id}', 'CartController@DeleteItemListCart')->name('delete-item-list-cart');
    Route::get('/Update-Item-List-Cart/{id}/{quanty}', 'CartController@UpdateItemListCart')->name('update-item-list-cart');

    Route::get('/danh-muc/{slug}-cate{id}', 'TrangDanhMucController@trangDanhMucNuocHoa')
            ->where('slug', '[a-zA-Z0-9-_]+')
            ->where('id', '[0-9]+')
            ->name('danh-muc-nuoc-hoa');

    // Xem thêm nước hoa của trang danh mục
    Route::post('/danh-muc/{id}', 'TrangDanhMucController@xemThemNuocHoa')->name('xem-them-nuoc-hoa');
    // Xem thêm nước hoa của trang người dùng
    Route::post('/xem-them-nuoc-hoa', 'UserController@xemThemNuocHoa')->name('xem-them-nuoc-hoa-nguoi-dung');
    
    // Tìm kiếm Typeahead 
    Route::get('/tim-kiem/ten', 'UserController@timKiemTheoTen')->name('tim-kiem-nuoc-hoa');

    // Danh sách nước hoa theo khuyến mãi
    Route::get('/khuyen-mai/{slug}-cate{id}', 'TrangKhuyenMaiController@trangKhuyenMaiNuocHoa')
            ->where('slug', '[a-zA-Z0-9-_]+')
            ->where('id', '[0-9]+')
            ->name('khuyen-mai-nuoc-hoa');

    // Xem thêm nước hoa của trang khuyến mãi
    Route::post('/khuyen-mai/{id}', 'TrangKhuyenMaiController@xemThemNuocHoa')->name('xem-them-nuoc-hoa-khuyen-mai');

    // Danh sách blog
    Route::get('/danh-sach-blog', 'TrangBlogController@trangDanhSachBlog')
            ->name('trang-danh-sach-blog');
    // Xem thêm blog của trang danh sach blog
    Route::post('/danh-sach-blog', 'TrangBlogController@xemThemBlog')->name('xem-them-blog');
    // Chi tiết Blog    
    Route::get('/blog/chi-tiet-blog/{slug}-pf{id}','TrangChiTietBlogController@trangChiTietBlog')
            ->where('slug', '[a-zA-Z0-9-_]+')
            ->where('id', '[0-9]+')
            ->name('trang-chi-tiet-blog');

    // Giới thiệu về TGNH
    Route::get('/gioi-thieu-ve-TGNH', 'GioiThieuTGNHController@gioiThieuTGNH')->name('gioi-thieu-ve-TGNH');
    
});
