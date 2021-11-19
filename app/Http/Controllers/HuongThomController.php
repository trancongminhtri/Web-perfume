<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HuongThom;
use Exception;
use App\Http\Requests\HuongThomRequest;
use App\ThongBao;

class HuongThomController extends Controller
{
    public function quanLyHuongThom(Request $request){
        $arrKey = [
            'ten_huong_thom'
        ];
        $inputSearch = [];
        foreach($arrKey as $key => $value){
            $inputSearch[$value] = $request[$value];
        }
        $dsHuongThom = HuongThom::queryDSHuongThom($request->toArray())->paginate(25);
        $thongBaoMoi = ThongBao::queryDSTrongBayNgay()->get();

        return view('admin.huong-thom.danh-sach-huong-thom', compact(['dsHuongThom', 'inputSearch', 'thongBaoMoi']));
    }

    // Thêm hương thơm
    public function themHuongThom(HuongThomRequest $request){
        $ten_huong_thom = $request->ten_huong_thom;
        $kt_ten = HuongThom::where('ten_huong_thom', $ten_huong_thom)->first();
        if($kt_ten){
            return response()->json([
                'status' => 'error',
                'message' => 'Tên Hương Thơm Đã Tồn Tại!'
            ],200);
        }else{
            $them_hth = new HuongThom();
            $them_hth->ten_huong_thom = $ten_huong_thom;
            $them_hth->save();
            if($them_hth){
                $dsHuongThom = HuongThom::queryDSHuongThom([])->paginate(25);
                $giao_dien_bang =  view('admin.huong-thom.bang-huong-thom', compact(['dsHuongThom']))->render();
                return response()->json([
                    'status' => 'success',
                    'message' => 'Thêm Hương Thơm Mới Thành Công!',
                    'giao_dien_bang' => $giao_dien_bang,
                ],200);
            }
        }
        return response()->json([
            'status' => 'error',
            'message' => 'Thêm Hương Thơm Mới Thất Bại!'
        ],200);
    }

    // Xóa hương thơm
    public function xoaHuongThom($id){
        try{
            HuongThom::find($id)->delete();
                $dsHuongThom = HuongThom::queryDSHuongThom([])->paginate(25);
                $giao_dien_bang =  view('admin.huong-thom.bang-huong-thom', compact(['dsHuongThom']))->render();
                return response()->json([
                    'status' => 'success',
                    'message' => 'Xóa Hương Thơm Thành Công!',
                    'giao_dien_bang' => $giao_dien_bang,
                ],200);
        }catch(Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => 'Xóa Hương Thơm Thất Bại!'
            ], 200);
        }
    }

    //Chi tiết hương thơm
    public function chiTietHuongThom($id){
        $kt_huong_thom = HuongThom::where('id', $id)->first();
        $giao_dien_cap_nhat =  view('admin.huong-thom.cap-nhat-huong-thom', compact(['kt_huong_thom']))->render();
        if($kt_huong_thom){
            return response()->json([
                'status' => 'success',
                'data' => $kt_huong_thom,
                'giao_dien_cap_nhat' => $giao_dien_cap_nhat,
            ],200);
        }
        return response()->json([
            'status'=>'error',
            'message'=>'Lỗi'
        ],200);
    }

    //Cập nhật hương thơm
    public function capNhatHuongThom(HuongThomRequest $request, $id){
        $ten_huong_thom = $request->ten_huong_thom;
        $kt_huong_thom = HuongThom::where('id', $id)->first();
        if($kt_huong_thom){
            if(empty($ten_huong_thom)){
                return response()->json([
                    'status'=>'error',
                    'message'=>'Vui Lòng Nhập Tên Hương Thơm!'
                ],200);
            }
            $kt_ton_tai = HuongThom::where([['id', '!=', $id], ['ten_huong_thom', $ten_huong_thom]])->first();
            if($kt_ton_tai){
                return response()->json([
                    'status'=>'error',
                    'message'=>'Tên Hương Thơm Đã Tồn Tại!'
                ],200);
            }
            $kt_huong_thom->ten_huong_thom = $ten_huong_thom;
            $kt_huong_thom->save();
            if($kt_huong_thom){
                $dsHuongThom = HuongThom::queryDSHuongThom([])->paginate(25);
                $giao_dien_bang =  view('admin.huong-thom.bang-huong-thom', compact(['dsHuongThom']))->render();
                return response()->json([
                    'status' => 'success',
                    'message' => 'Cập Nhật Hương Thơm Thành Công!',
                    'giao_dien_bang' => $giao_dien_bang,
                ],200);
            }
        }
        return response()->json([
            'status'=>'error',
            'message'=>'Cập Nhật Hương Thơm Thất Bại!'
        ],200);
    }
}
