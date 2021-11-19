<?php

namespace App\Http\Controllers;

use App\NhanXetDanhGia;
use Illuminate\Http\Request;
use Exception;
use App\ThongBao;

class NhanXetDanhGiaController extends Controller
{
    public function quanLyNhanXetDanhGia(Request $request){
        $arrKey = [
            'email_nguoi_dung',
            'ten_nuoc_hoa',
            'diem_danh_gia',
        ];
        $inputSearch = [];
        foreach ($arrKey as $key => $value) {
            $inputSearch[$value] = $request[$value];
        }
        $dsBinhLuan = NhanXetDanhGia::queryDSBinhLuanGiamDan($request->toArray())->paginate(25);
        $thongBaoMoi = ThongBao::queryDSTrongBayNgay()->get();
        return view('admin.nhan-xet-danh-gia.danh-sach-nhan-xet-danh-gia', compact(['dsBinhLuan', 'thongBaoMoi']));
    }

    // Xóa bình luận
    public function xoaNhanXetDanhGia($id){
        try{
            NhanXetDanhGia::find($id)->delete();
            $dsBinhLuan = NhanXetDanhGia::queryDSBinhLuanGiamDan([])->paginate(25);
            $giao_dien_bang =  view('admin.nhan-xet-danh-gia.bang-danh-gia', compact(['dsBinhLuan']))->render();
            return response()->json([
                'status' => 'success',
                'message' => 'Xóa Nhận Xét Và Đánh Giá Thành Công!',
                'giao_dien_bang' => $giao_dien_bang,
            ],200);
        }catch(Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => 'Xóa Nhận Xét Và Đánh Giá Thất Bại!'
            ], 200);
        }
    }
}
