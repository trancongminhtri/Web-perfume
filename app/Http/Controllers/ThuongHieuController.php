<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ThuongHieu;
use Exception;
use App\Http\Requests\ThuongHieuRequest;
use App\ThongBao;

class ThuongHieuController extends Controller
{
    public function quanLyThuongHieu(Request $request){
        $arrKey = [
            'ten_thuong_hieu'
        ];
        $inputSearch = [];
        foreach($arrKey as $key => $value){
            $inputSearch[$value] = $request[$value];
        }
        $dsThuongHieu = ThuongHieu::queryDSThuongHieu($request->toArray())->paginate(25);
        $thongBaoMoi = ThongBao::queryDSTrongBayNgay()->get();
        return view('admin.thuong-hieu.danh-sach-thuong-hieu', compact(['dsThuongHieu','inputSearch', 'thongBaoMoi']));
    }

    // Thêm thương hiệu
    public function themThuongHieu(ThuongHieuRequest $request){
        $ten_thuong_hieu = $request->ten_thuong_hieu;
        $kt_ten = ThuongHieu::where('ten_thuong_hieu', $ten_thuong_hieu)->first();
        if($kt_ten){
            return response()->json([
                'status' => 'error',
                'message' => 'Tên Thương Hiệu Đã Tồn Tại!'
            ],200);
        }else{
            $them_thh = new ThuongHieu();
            $them_thh->ten_thuong_hieu = $ten_thuong_hieu;
            $them_thh->save();
            if($them_thh){
                $dsThuongHieu = ThuongHieu::queryDSThuongHieu([])->paginate(25);
                $giao_dien_bang = view('admin.thuong-hieu.bang-thuong-hieu', compact(['dsThuongHieu']))->render();
                return response()->json([
                    'status' => 'success',
                    'message' => 'Thêm Thương Hiệu Mới Thành Công!',
                    'giao_dien_bang' => $giao_dien_bang
                ],200);
            }
        }
        return response()->json([
            'status' => 'error',
            'message' => 'Thêm Thương Hiệu Mới Thất Bại!'
        ],200);
    }

    // Xóa thương hiệu
    public function xoaThuongHieu($id){
        try{
            ThuongHieu::find($id)->delete();
            $dsThuongHieu = ThuongHieu::queryDSThuongHieu([])->paginate(25);
            $giao_dien_bang = view('admin.thuong-hieu.bang-thuong-hieu', compact(['dsThuongHieu']))->render();
            return response()->json([
                'status' => 'success',
                'message' => 'Xóa Thương Hiệu Thành Công!',
                'giao_dien_bang' => $giao_dien_bang,
            ],200);
        }catch(Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => 'Xóa Hương Thơm Thất Bại!'
            ], 200);
        }
    }

    //Chi tiết thương hiệu
    public function chiTietThuongHieu($id){
        $kt_thuong_hieu = ThuongHieu::where('id', $id)->first();
        $giao_dien_cap_nhat = view('admin.thuong-hieu.cap-nhat-thuong-hieu', compact(['kt_thuong_hieu']))->render();
        if($kt_thuong_hieu){
            return response()->json([
                'status' => 'success',
                'data' => $kt_thuong_hieu,
                'giao_dien_cap_nhat' => $giao_dien_cap_nhat,
            ],200);
        }
        return response()->json([
            'status'=>'error',
            'message'=>'Lỗi'
        ],200);
    }

    //Cập nhật thương hiệu
    public function capNhatThuongHieu(ThuongHieuRequest $request, $id){
        $ten_thuong_hieu = $request->ten_thuong_hieu;
        $kt_thuong_hieu = ThuongHieu::where('id', $id)->first();
        if($kt_thuong_hieu){
            if(empty($ten_thuong_hieu)){
                return response()->json([
                    'status'=>'error',
                    'message'=>'Vui Lòng Nhập Tên Thương Hiệu!'
                ],200);
            }
            $kt_ton_tai = ThuongHieu::where([['id', '!=', $id], ['ten_thuong_hieu', $ten_thuong_hieu]])->first();
            if($kt_ton_tai){
                return response()->json([
                    'status'=>'error',
                    'message'=>'Tên Thương Hiệu Đã Tồn Tại!'
                ],200);
            }
            $kt_thuong_hieu->ten_thuong_hieu = $ten_thuong_hieu;
            $kt_thuong_hieu->save();
            if($kt_thuong_hieu){
                $dsThuongHieu = ThuongHieu::queryDSThuongHieu([])->paginate(25);
                $giao_dien_bang = view('admin.thuong-hieu.bang-thuong-hieu', compact(['dsThuongHieu']))->render();
                return response()->json([
                    'status' => 'success',
                    'message' => 'Cập Nhật Thương Hiệu Thành Công!',
                    'giao_dien_bang' => $giao_dien_bang,
                ],200);
            }
        }
        return response()->json([
            'status'=>'error',
            'message'=>'Cập Nhật Thương Hiệu Thất Bại!'
        ],200);
    }
}
