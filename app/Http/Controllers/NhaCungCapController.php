<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\NhaCungCap;
use Exception;
use App\Http\Requests\NhaCungCapRequest;
use App\ThongBao;

class NhaCungCapController extends Controller
{
    public function quanLyNCC(Request $request){
        $arrKey = [
            'ten_ncc'
        ];
        $inputSearch = [];
        foreach($arrKey as $key => $value){
            $inputSearch[$value] = $request[$value];
        }
        $dsNCC = NhaCungCap::queryDSNCC($request->toArray())->paginate(25);
        $thongBaoMoi = ThongBao::queryDSTrongBayNgay()->get();
        return view('admin.nha-cung-cap.danh-sach-ncc', compact(['dsNCC', 'thongBaoMoi']));
    }

    // Thêm nhà cung cấp
    public function themNCC(NhaCungCapRequest $request){
        $ten_ncc = $request->ten_ncc;
        $sdt_ncc = $request->sdt_ncc;
        $email_ncc = $request->email_ncc;
        $dia_chi_ncc = $request->dia_chi_ncc;
        $kt_ten = NhaCungCap::where('ten_ncc', $ten_ncc)->first();
        $kt_email = NhaCungCap::where('email_ncc', $email_ncc)->first();
        if($kt_ten){
            return response()->json([
                'status' => 'error',
                'message' => 'Tên Nhà Cung Cấp Đã Tồn Tại!'
            ],200);
        }else{
            if($kt_email){
                return response()->json([
                    'status' => 'error',
                    'message' => 'Email Nhà Cung Cấp Đã Tồn Tại!'
                ],200);
            }else{
                $them_ncc = new NhaCungCap();
                $them_ncc->ten_ncc = $ten_ncc;
                $them_ncc->sdt_ncc = $sdt_ncc;
                $them_ncc->email_ncc = $email_ncc;
                $them_ncc->dia_chi_ncc  = $dia_chi_ncc;
                $them_ncc->save();
                if($them_ncc){
                    $dsNCC = NhaCungCap::queryDSNCC([])->paginate(25);
                    $giao_dien_ncc = view('admin.nha-cung-cap.bang-ncc', compact(['dsNCC']))->render();
                    return response()->json([
                        'status' => 'success',
                        'message' => 'Thêm Nhà Cung Cấp Mới Thành Công!',
                        'giao_dien_ncc' => $giao_dien_ncc,
                    ],200);
                }
            }
        }
        return response()->json([
            'status' => 'error',
            'message' => 'Thêm Nhà Cung Cấp Mới Thất Bại!'
        ],200);
    }

    // Xóa nhà cung cấp
    public function xoaNCC($id){
        try{
            NhaCungCap::find($id)->delete();
            $dsNCC = NhaCungCap::queryDSNCC([])->paginate(25);
            $giao_dien_ncc = view('admin.nha-cung-cap.bang-ncc', compact(['dsNCC']))->render();
            return response()->json([
                'status' => 'success',
                'message' => 'Xóa Nhà Cung Cấp Thành Công!',
                'giao_dien_ncc' => $giao_dien_ncc,
            ], 200);
        }catch(Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => 'Xóa Nhà Cung Cấp Thất Bại!'
            ], 200);
        }
    }

    //Chi tiết nhà cung cấp
    public function chiTietNCC($id){
        $kt_ncc = NhaCungCap::where('id', $id)->first();
        $giao_dien_cap_nhat = view('admin.nha-cung-cap.cap-nhat-ncc', compact(['kt_ncc']))->render();
        if($kt_ncc){
            return response()->json([
                'status' => 'success',
                'data' => $kt_ncc,
                'giao_dien_cap_nhat' => $giao_dien_cap_nhat,
            ],200);
        }
        return response()->json([
            'status'=>'error',
            'message'=>'Lỗi'
        ],200);
    }

    //Cập nhật nhà cung cấp
    public function capNhatNCC(NhaCungCapRequest $request, $id){
        $ten_ncc = $request->ten_ncc;
        $sdt_ncc = $request->sdt_ncc;
        $email_ncc = $request->email_ncc;
        $dia_chi_ncc = $request->dia_chi_ncc;
        $kt_ncc = NhaCungCap::where('id', $id)->first();
        if($kt_ncc){
            if(empty($ten_ncc)){
                return response()->json([
                    'status'=>'error',
                    'message'=>'Vui Lòng Nhập Tên Nhà Cung Cấp!'
                ],200);
            }else{
                if(empty($sdt_ncc)){
                    return response()->json([
                        'status'=>'error',
                        'message'=>'Vui Lòng Nhập Số Điện Thoại Nhà Cung Cấp!'
                    ],200);
                }else{
                    if(strlen($sdt_ncc) > 10){
                        return response()->json([
                            'status'=>'error',
                            'message'=>'Số Điện Thoại Không Đúng!'
                        ],200);
                    }else{
                        if(empty($email_ncc)){
                            return response()->json([
                                'status'=>'error',
                                'message'=>'Vui Lòng Nhập Email Nhà Cung Cấp!'
                            ],200);
                        }else{
                            if(empty($dia_chi_ncc)){
                                return response()->json([
                                    'status'=>'error',
                                    'message'=>'Vui Lòng Nhập Địa Chỉ Nhà Cung Cấp!'
                                ],200);
                            }
                        }
                    }
                }
            }
            $kt_ton_tai = NhaCungCap::
                            where([['id', '!=', $id], ['ten_ncc', $ten_ncc]])
                            ->orwhere([['id', '!=', $id], ['email_ncc', $email_ncc]])
                            ->first();
            if($kt_ton_tai){
                return response()->json([
                    'status'=>'error',
                    'message'=>'Tên hoặc Email Nhà Cung Cấp Đã Tồn Tại!'
                ],200);
            }
            $kt_ncc->ten_ncc = $ten_ncc;
            $kt_ncc->sdt_ncc = $sdt_ncc;
            $kt_ncc->email_ncc = $email_ncc;
            $kt_ncc->dia_chi_ncc = $dia_chi_ncc;
            $kt_ncc->save();
            if($kt_ncc){
                $dsNCC = NhaCungCap::queryDSNCC([])->paginate(25);
                $giao_dien_ncc = view('admin.nha-cung-cap.bang-ncc', compact(['dsNCC']))->render();
                return response()->json([
                    'status'=>'success',
                    'message' => 'Cập Nhật Nhà Cung Cấp Thành Công!',
                    'giao_dien_ncc' => $giao_dien_ncc,
                ],200);
            }
        }
        return response()->json([
            'status'=>'error',
            'message'=>'Cập Nhật Nhà Cung Cấp Thất Bại!'
        ],200);
    }
}
