<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PhieuNhap;
use App\ChiTietPhieuNhap;
use App\NuocHoa;
use App\NhaCungCap;
use Exception;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Http\Requests\PhieuNhapRequest;
use Illuminate\Support\Facades\DB;
use App\ThongBao;
use Illuminate\Support\Str;

class PhieuNhapController extends Controller
{
    public function quanLyPhieuNhap(Request $request)
    {
        $arrKey = [
            'from_date'
        ];
        $inputSearch = [];
        foreach ($arrKey as $key => $value) {
            $inputSearch[$value] = $request[$value];
        }

        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
        $thongBaoMoi = ThongBao::queryDSTrongBayNgay()->get();

        $dsPhieuNhap = PhieuNhap::queryDSPhieuNhap($request->toArray())->paginate(25);
        return view('admin.phieu-nhap.danh-sach-phieu-nhap', compact(['inputSearch', 'now', 'thongBaoMoi', 'dsPhieuNhap']));
    }

    public function trangThemPhieuNhap() {
        $thongBaoMoi = ThongBao::queryDSTrongBayNgay()->get();
        $nuocHoa = NuocHoa::queryDSNuocHoaTangDan()->get();
        $nhaCungCap = NhaCungCap::queryDSNCCTangDan()->get();
        return view('admin.phieu-nhap.them-phieu-nhap', compact(['thongBaoMoi', 'nuocHoa', 'nhaCungCap']));
    }

    // Thêm phiếu nhập
    public function themPhieuNhap(PhieuNhapRequest $request)
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $tong_so_luong_nhap = $request -> tong_so_luong_nhap;
        $ngay_nhap          = $request -> ngay_nhap;
        $tong_tien_nhap     = $request -> tong_tien_nhap;
        $nha_cung_cap_id    = $request -> nha_cung_cap_id;
    
        $them_phieu_nhap = new PhieuNhap();
        $them_phieu_nhap->ncc_id        = $nha_cung_cap_id;
        $them_phieu_nhap->quan_ly_id    =auth()->user()->id;
        $them_phieu_nhap->tong_so_luong =$tong_so_luong_nhap;
        $them_phieu_nhap->tong_tien     =$tong_tien_nhap;
        $them_phieu_nhap->ngay_nhap     =$ngay_nhap;
        $them_phieu_nhap->save();
        
        // Thêm chi tiết phiếu nhập
        if($them_phieu_nhap) {
            $data_value_item    = $request -> data_value_item;
            for($i = 0; $i < count($data_value_item); $i++) {
                $them_chi_tiet_phieu_nhap = new ChiTietPhieuNhap();
                $them_chi_tiet_phieu_nhap->phieu_nhap_id     = $them_phieu_nhap->id;

                $arr1 = explode(',', $data_value_item[$i]);
                $them_chi_tiet_phieu_nhap->nuoc_hoa_id       =  $arr1[0];
                $them_chi_tiet_phieu_nhap->gia_tien_nuoc_hoa =  $arr1[1];
                $them_chi_tiet_phieu_nhap->so_luong_nhap     = $arr1[2];
                $them_chi_tiet_phieu_nhap->save();

                // Cộng số lượng nước hoa vừa nhập vào số lượng tồn của nước hoa đó
                $nuoc_hoa = NuocHoa::where('id', $arr1[0])->first();
                $nuoc_hoa->so_luong_ton +=  $arr1[2];
                $nuoc_hoa->trang_thai = $nuoc_hoa->so_luong_ton <= 4 ? false : true;
                $nuoc_hoa->save();
            }
            return response()->json([
                'status' => 'success',
                'message' => 'Thêm Phiếu Nhập Mới Thành Công!'
            ], 200);
        }
        
        return response()->json([
            'status' => 'error',
            'message' => 'Thêm Phiếu Nhập Mới Thất Bại!'
        ], 200);
        
        
    }

    //Chi tiết phiếu nhập
    public function chiTietPhieuNhap($id)
    {
        $kt_phieu_nhap = PhieuNhap::queryPhieuNhapTheoID($id)->first();
        
        if ($kt_phieu_nhap) {
            return response()->json([
                'status' => 'success',
                'data' => $kt_phieu_nhap
            ], 200);
        }
        return response()->json([
            'status' => 'error',
            'message' => 'Lỗi'
        ], 200);
    }
}
