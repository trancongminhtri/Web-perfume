<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DonHang;
use App\ChiTietDonHang;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use App\Http\Requests\CapNhatThongTinRequest;

class NguoiDungController extends Controller
{
    // Trang thông tin người dung
    public function thongTinHoSo(){
        $dsDonHang = DonHang::queryDSDonHangIDNguoiDung(auth()->user()->id)->get();
        $arrDonHang = array();
        $arrChiTietDonHang = array();
        foreach($dsDonHang as $key => $donHang){
            $arrDonHang[$key] = $donHang;
            $dsChiTietDonHang = ChiTietDonHang::queryDSChiTietDonHangTheoIDHD($donHang['id'])->get();
            foreach($dsChiTietDonHang as $key1 => $chiTietDonHang){
                $arrChiTietDonHang[$key1] = $chiTietDonHang;
            }
            $arrDonHang[$key]['nuoc_hoa'] =  $arrChiTietDonHang;
        }
        return view('thong-tin-user.thong-tin-tai-khoan', compact(['dsDonHang', 'arrDonHang']));
    }

     // Trang cập nhật thông tin người dung
     public function trangCapNhatHoSo(){
        return view('thong-tin-user.cap-nhat-thong-tin');
    }

    // Cập nhật thông tin người dung
    public function capNhatHoSo(CapNhatThongTinRequest $request){
        $ho_ten           = $request->ho_ten;
        $sdt              = $request->sdt;
        $dia_chi          = $request->dia_chi;
        $mat_khau_moi     = $request->mat_khau_moi;
        $mat_khau_lai     = $request->mat_khau_lai;
        $sua_thong_tin    = User::where('id', auth()->user()->id)->first();
     
        // Xóa avatar thay đổi
        $data_add_avatar = $request->data_add_avatar;
        if(!empty($data_add_avatar)){
            $delete_file_avatar = public_path().'/'.$sua_thong_tin->anh_dai_dien;
            File::delete($delete_file_avatar);
        }
        // Cập nhật thông tin admin
        $sua_thong_tin->ho_ten = $ho_ten;
        $sua_thong_tin->sdt = $sdt;
        $sua_thong_tin->dia_chi = $dia_chi;
        if(!empty($mat_khau_moi)){
            if(!empty($mat_khau_lai)){
                if($mat_khau_moi == $mat_khau_lai){
                    $sua_thong_tin->password = Hash::make($mat_khau_moi);
                }else{
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Mật Khẩu Lại Không Trùng Khớp!'
                    ], 200);
                }
            }else{
                return response()->json([
                    'status' => 'error',
                    'message' => 'Vui Lòng Nhập Lại Mật Khẩu!'
                ], 200);
            }
        }
        if(!empty($data_add_avatar)){
            // Lưu avatar mới
            // Xử lý thông tin hình ảnh
            $originName = $data_add_avatar->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $data_add_avatar->getClientOriginalExtension();
            // thuộc tính trong cột
            $ten_file_avatar = $fileName . time() . '.' . $extension;
            $sua_thong_tin->anh_dai_dien = 'assets/img/img_avatar/' . $ten_file_avatar;
            $data_add_avatar->move(public_path('assets/img/img_avatar'), $ten_file_avatar);
        }
        $sua_thong_tin->save();
        if($sua_thong_tin){
            return response()->json([
                'status' => 'success',
                'message' => 'Cập Nhật Thông Tin Hồ Sơ Thành Công!'
            ], 200);
        }     
        return response()->json([
            'status' => 'error',
            'message' => 'Cập Nhật Thông Tin Hồ Sơ Thất Bại!'
        ], 200);
    }
}
