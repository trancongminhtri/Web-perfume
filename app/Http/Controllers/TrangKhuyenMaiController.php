<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DonHang;
use App\ThuongHieu;
use App\GioiTinh;
use App\DungTich;
use App\KhuyenMai;
use App\NuocHoa;
use App\DanhMucSanPham;

class TrangKhuyenMaiController extends Controller
{
    //Trang chủ người dùng website
    public function trangKhuyenMaiNuocHoa(Request $request, $slug, $id){
        $timKhuyenMai = KhuyenMai::find($id);
        
        $inputSearch = [];
        $arrKey = [
            'gioi_tinh_id',
            'thuong_hieu_id',
            'dung_tich_id',
            'ten_nuoc_hoa',
            'gia_tien_lon',
            'gia_tien_nho',
        ];
       
        foreach($arrKey as $key => $value){
            $inputSearch[$value] = $request[$value];
        }
        if($request->ajax()){
            $dsNuocHoa = NuocHoa::queryDSNuocHoaKhuyenMai($request->toArray(), $id)->get();
            return view('khuyen-mai-nuoc-hoa.nuoc-hoa', compact(['dsNuocHoa', 'timKhuyenMai']));   
        }
        $lastId = '';
        $dsDanhMuc = DanhMucSanPham::queryDSDanhMucTangDan()->get();
        $dsKhuyenMai = KhuyenMai::queryDSKhuyenMaiTangDan()->get();
        $dsNuocHoa = NuocHoa::queryDSNuocHoaKhuyenMai($request->toArray(), $id)->get();
        $dsThuongHieu = ThuongHieu::queryDSThuongHieuTangDan()->get();
        $dsGioiTinh = GioiTinh::all();
        $dsDungTich = DungTich::all();
        $select_category = '';
        $select_promotion = $id;
        return view('khuyen-mai-nuoc-hoa.trang-khuyen-mai', compact(['dsDanhMuc', 'dsNuocHoa', 'timKhuyenMai', 'lastId', 'dsThuongHieu', 'dsGioiTinh', 'dsDungTich', 'select_category', 'dsKhuyenMai', 'select_promotion']));
    }

    public function xemThemNuocHoa(Request $request, $id){
        if ($request->ajax()) {
            $inputSearch = [
                'gioi_tinh_id' => $request->gioi_tinh_id,
                'thuong_hieu_id' => $request->thuong_hieu_id,
                'dung_tich_id' => $request->dung_tich_id,
                'gia_tien_lon' => $request->gia_tien_lon,
                'gia_tien_nho' => $request->gia_tien_nho,
            ];
            $timKhuyenMai = KhuyenMai::find($id);
            $lastId = '';
            $minId = NuocHoa::where('khuyen_mai_id', $id)->min('id');
            if($minId < $request->last_id){
                $dsNuocHoa = NuocHoa::queryNuocHoaKhuyenMaiXemThem($id, $request->last_id, $inputSearch)->get();
                if(count($dsNuocHoa) != 0){
                    return view('khuyen-mai-nuoc-hoa.nuoc-hoa', compact(['dsNuocHoa', 'timKhuyenMai', 'lastId']));
                }
                return;
               
            }
        }
    }
}