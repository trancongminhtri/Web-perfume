<?php

namespace App\Http\Controllers;

use App\ChiTietDonHang;
use Illuminate\Http\Request;
use App\DonHang;
use App\NuocHoa;
use App\TrangThaiDonHang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\ThongBao;

class DonHangController extends Controller
{
    // Trang danh sách đơn hàng
    public function quanLyDonHang(Request $request){
        $arrKey = [
            'don_hang_id',
            'trang_thai',
        ];
        $inputSearch = [];
        foreach($arrKey as $key => $value){
            $inputSearch[$value] = $request[$value];
        }
        $dsTrangThai = TrangThaiDonHang::all();
        $dsDonHang = DonHang::queryDSDonHang($request->toArray())->paginate(25);
        $thongBaoMoi = ThongBao::queryDSTrongBayNgay()->get();

        return view('admin.don-hang.danh-sach-don-hang', compact(['dsDonHang', 'dsTrangThai', 'inputSearch', 'thongBaoMoi']));
    }

    // Chi tiết đơn hàng
    public function chiTietDonHang($id){
        $dsTrangThai = TrangThaiDonHang::all();
        $timDonHang = DonHang::queryTimDonHang($id)->first();
        $dsChiTiet = ChiTietDonHang::queryDSChiTietDonHangTheoIDHD($id)->get();
        $thongBaoMoi = ThongBao::queryDSTrongBayNgay()->get();
        return view("admin.don-hang.cap-nhat-don-hang",compact(['timDonHang', 'dsTrangThai', 'dsChiTiet', 'thongBaoMoi']));
    }

    // Cập nhật trạng thái đơn hàng
    public function capNhatDonHang(Request $request ,$id){
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $suaDonHang = DonHang::where('id', $id)->first();
        $dsChiTiet = ChiTietDonHang::queryDSChiTietDonHangTheoIDHD($id)->get();
        $khach_hang = DonHang::find($suaDonHang->id)->khachHang;

        if($request->trang_thai_id == 4){
            foreach($dsChiTiet as $chiTiet){
                $nuocHoa = NuocHoa::where('id', $chiTiet->nuoc_hoa_id)->first();
                $nuocHoa->so_luong_ton += $chiTiet->so_luong_san_pham;
                $nuocHoa->save();
            }
            $suaDonHang->trang_thai_id = $request->trang_thai_id;

            $data = [
                'don_hang' =>  $suaDonHang,
                'ds_chi_tiet' => $dsChiTiet,
                'trang_thai' => 'Hủy đơn hàng',
            ];
            Mail::to($khach_hang->email)->send(new \App\Mail\DonHangHuyMail($data));
        }else{
            if($request->trang_thai_id == 2){
                $suaDonHang->trang_thai_id = $request->trang_thai_id;

                $data = [
                    'don_hang' =>  $suaDonHang,
                    'ds_chi_tiet' => $dsChiTiet,
                    'trang_thai' => 'Đã xử lý đơn hàng',
                ];
                Mail::to($khach_hang->email)->send(new \App\Mail\DonHangDaXuLyMail($data));
            }
            else{      
                $suaDonHang->trang_thai_id = $request->trang_thai_id;
            }
        }
        $suaDonHang->quan_ly_id = auth()->user()->id;
        $suaDonHang->save();
        if($suaDonHang->save()){
            return response()->json([
                'status' => 'success',
                'message' => 'Cập Nhật Đơn Hàng Thành Công!'
            ], 200);
        }
        return response()->json([
            'status' => 'error',
            'message' => 'Cập Nhật Đơn Hàng Thất Bại!'
        ], 200);;
    }
}
