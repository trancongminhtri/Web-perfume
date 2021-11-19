<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\NuocHoa;
use App\DonHang;
use App\NhanXetDanhGia;

class TrangChiTietController extends Controller
{
    // Trang chi tiết sản phẩm cho người dùng xem
    public function trangChiTietNuocHoa($slug, $id){
        // Danh sách hương thơm
        $dsHuongThom = NuocHoa::find($id)->huongthom()->get();
        $mangHuongThom = [];
        foreach($dsHuongThom as $key => $huongThom){
            $mangHuongThom[$key] = $huongThom['ten_huong_thom'];
        }

        // Danh sách ảnh bìa nước hoa
        $dsHinh = NuocHoa::find($id)->dsAnhBiaNuocHoa()->paginate(5);
        $mangHinh = [];
        foreach($dsHinh as $key => $hinh){
            $mangHinh[$key] = $hinh['duong_dan'];
        }
        // Thông tin nước hoa theo id
        $nuocHoa = NuocHoa::queryThongTinNuocHoaID($id)->first();

        // Giá tiền thực tế khi đã khuyến mãi
        $giaTien = $nuocHoa->gia_tien - ($nuocHoa->gia_tien * ($nuocHoa->gia_khuyen_mai / 100));

        // Nước hoa cùng thương hiệu
        $dsThuongHieuSP = NuocHoa::queryDSNuocHoaLienQuan($nuocHoa->thuong_hieu_id, $id)->limit(5)->get();

        // Danh sách nhận xét và đánh giá
        $dsBinhLuan = NhanXetDanhGia::queryDSNhanXetDanhGia($id)->get();
        $diemDanhGiaTB = (int)$dsBinhLuan->avg('diem_danh_gia');
        $luotDanhGia = $dsBinhLuan->count('diem_danh_gia');
        
        return view('chi-tiet-nuoc-hoa.chi-tiet-nuoc-hoa', compact(['mangHuongThom', 'mangHinh', 'nuocHoa', 'giaTien', 'dsThuongHieuSP', 'dsBinhLuan', 'diemDanhGiaTB', 'luotDanhGia']));
    }

    // Nhận xét đánh giá 
    public function nhanXetDanhGia(Request $request, $id) {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $arrID = [
            'khach_hang_id' => auth()->user()->id,
            'nuoc_hoa_id' => $id,
        ];
        
        if(empty($request->check)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Vui Lòng Đánh Giá Nước Hoa!',
                // 'giao_dien_bang' => $giao_dien_bang,
            ],200);
        } else {
            $kiemTraDonDonHang = DonHang::queryKiemTraDonHang($arrID)->exists();

            if($kiemTraDonDonHang) {
                $them_binh_luan = new NhanXetDanhGia();
                $them_binh_luan->nuoc_hoa_id = $id;
                $them_binh_luan->nguoi_dung_id = auth()->user()->id;
                $them_binh_luan->diem_danh_gia = $request->check;
                $them_binh_luan->noi_dung_danh_gia = $request->comment;
                $them_binh_luan->save();
                if($them_binh_luan){
                    // Lấy hết tất cả các danh sách bl ra
                    $dsBinhLuan = NhanXetDanhGia::queryDSNhanXetDanhGia($id)->get();
                    $diemDanhGiaTB = (int)$dsBinhLuan->avg('diem_danh_gia');
                    $luotDanhGia = $dsBinhLuan->count('diem_danh_gia');
                    // view -> .blade dữ liệu -> dsDanhMuc
                    $giao_dien_binh_luan = view('chi-tiet-nuoc-hoa.nhan-xet-danh-gia', compact(['dsBinhLuan', 'diemDanhGiaTB', 'luotDanhGia']))->render();

                    $luot_danh_gia = view('chi-tiet-nuoc-hoa.luot-danh-gia', compact(['diemDanhGiaTB', 'luotDanhGia']))->render();
                    return response()->json([
                        'status' => 'success',
                        'message' => 'Thêm Bình Luận Thành Công!',
                        'giao_dien_binh_luan' => $giao_dien_binh_luan,
                        'luot_danh_gia' => $luot_danh_gia,
                    ],200);
                }
                return response()->json([
                    'status' => 'error',
                    'message' => 'Thêm Bình Luận Thất Bại!',
                ],200);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Bạn chưa mua sản phẩm này!',
                ],200);
            }
        }
    }
}
