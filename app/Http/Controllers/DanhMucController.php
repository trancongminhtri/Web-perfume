<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DanhMucSanPham;
use Exception;
use App\Http\Requests\DanhMucRequest;
use App\ThongBao;

class DanhMucController extends Controller
{
    public function quanLyDanhMuc(Request $request)
    {
        $arrKey = [
            'ten_danh_muc'
        ];
        $inputSearch = [];
        foreach ($arrKey as $key => $value) {
            $inputSearch[$value] = $request[$value];
        }
        $dsDanhMuc = DanhMucSanPham::queryDSDanhMuc($request->toArray())->paginate(25);
        $thongBaoMoi = ThongBao::queryDSTrongBayNgay()->get();
        return view('admin.danh-muc.danh-sach-danh-muc', compact(['dsDanhMuc', 'inputSearch', 'thongBaoMoi']));
    }

    // Thêm danh mục
    public function themDanhMuc(DanhMucRequest $request)
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $ten_danh_muc = $request->ten_danh_muc;
        $kt_ten = DanhMucSanPham::where('ten_danh_muc', $ten_danh_muc)->first();
        if ($kt_ten) {
            return response()->json([
                'status' => 'error',
                'message' => 'Tên Danh Mục Đã Tồn Tại!'
            ], 200);
        } else {
            $them_danh_muc = new DanhMucSanPham();
            $them_danh_muc->ten_danh_muc = $ten_danh_muc;
            $them_danh_muc->save();
            if ($them_danh_muc) {
                $dsDanhMuc = DanhMucSanPham::queryDSDanhMuc([])->paginate(25);
                $giao_dien_nuoc_hoa = view('admin.danh-muc.nuoc-hoa', compact(['dsDanhMuc']))->render();
                return response()->json([
                    'status' => 'success',
                    'message' => 'Thêm Danh Mục Mới Thành Công!',
                    'giao_dien_nuoc_hoa' => $giao_dien_nuoc_hoa,
                ]);
            }
        }
        return response()->json([
            'status' => 'error',
            'message' => 'Thêm Danh Mục Mới Thất Bại!'
        ], 200);
    }

    // Xóa danh mục
    public function xoaDanhMuc($id)
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        try {
            // Cập nhật lại danh mục nước hoa bằng null
            DanhMucSanPham::querycapNhapNuocHoa($id)->get();
            DanhMucSanPham::find($id)->delete();
            $dsDanhMuc = DanhMucSanPham::queryDSDanhMuc([])->paginate(25);
            $giao_dien_nuoc_hoa = view('admin.danh-muc.nuoc-hoa', compact(['dsDanhMuc']))->render();
            return response()->json([
                'status' => 'success',
                'message' => 'Xóa Danh Mục Thành Công!',
                'giao_dien_nuoc_hoa' => $giao_dien_nuoc_hoa,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Xóa Danh Mục Thất Bại!'
            ], 200);
        }
    }

    //Chi tiết danh mục
    public function chiTietDanhMuc($id)
    {
        $kt_danh_muc = DanhMucSanPham::where('id', $id)->first();
        $giao_dien_cap_nhat = view('admin.danh-muc.cap-nhat-danh-muc', compact(['kt_danh_muc']))->render();
        if ($kt_danh_muc) {
            return response()->json([
                'status' => 'success',
                'data' => $kt_danh_muc,
                'giao_dien_cap_nhat' => $giao_dien_cap_nhat,
            ], 200);
        }
        return response()->json([
            'status' => 'error',
            'message' => 'Lỗi'
        ], 200);
    }

    //Cập nhật danh mục
    public function capNhatDanhMuc(DanhMucRequest $request, $id)
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $ten_danh_muc = $request->ten_danh_muc;
        $kt_danh_muc = DanhMucSanPham::where('id', $id)->first();
        if ($kt_danh_muc) {
            if (empty($ten_danh_muc)) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Vui Lòng Nhập Tên Danh Mục!'
                ], 200);
            }
            $kt_ton_tai = DanhMucSanPham::where([['id', '!=', $id], ['ten_danh_muc', $ten_danh_muc]])->first();
            if ($kt_ton_tai) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Tên Danh Mục Đã Tồn Tại!'
                ], 200);
            }
            $kt_danh_muc->ten_danh_muc = $ten_danh_muc;
            $kt_danh_muc->save();
            if ($kt_danh_muc) {
                $dsDanhMuc = DanhMucSanPham::queryDSDanhMuc([])->paginate(25);
                $giao_dien_nuoc_hoa = view('admin.danh-muc.nuoc-hoa', compact(['dsDanhMuc']))->render();
                return response()->json([
                    'status' => 'success',
                    'message' => 'Cập Nhật Thành Công!',
                    'giao_dien_nuoc_hoa' => $giao_dien_nuoc_hoa,
                ]);
                return response()->json([
                    'status' => 'success',
                ], 200);
            }
        }
        return response()->json([
            'status' => 'error',
            'message' => 'Cập Nhật Danh Mục Thất Bại!'
        ], 200);
    }
}
