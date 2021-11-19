<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SlideShow;
use Illuminate\Support\Facades\File;
use Exception;
use App\Http\Requests\SlideShowRequest;
use App\ThongBao;

class SlideShowController extends Controller
{
    public function quanLySlideShow(Request $request)
    {
        $arrKey = [
            'ten_slideshow',
        ];
        $inputSearch = [];
        foreach ($arrKey as $key => $value) {
            $inputSearch[$value] = $request[$value];
        }
        $dsSlideShow = SlideShow::queryDSSlideShow($request->toArray())->paginate(25);
        $thongBaoMoi = ThongBao::queryDSTrongBayNgay()->get();
        return view('admin.slideshow.danh-sach-slideshow', compact(['inputSearch', 'dsSlideShow', 'thongBaoMoi']));
    }

    // trang thêm slideshow
    public function trangThemSlideShow()
    {
        $thongBaoMoi = ThongBao::queryDSTrongBayNgay()->get();
        return view('admin.slideshow.them-slideshow', compact(['thongBaoMoi']));
    }

    // Thêm slideshow
    public function themSlideShow(SlideShowRequest $request)
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $ten                = $request->ten;
        $mo_ta              = $request->mo_ta;
        $trang_thai         = $request->trang_thai;
        $data_slideshow     = $request->data_slideshow;

        $check_ten          = SlideShow::where('ten', $ten)->first();
        if($check_ten){
            return response()->json([
                'status' => 'error',
                'message' => 'Tên SlideShow Đã Tồn Tại!'
            ], 200);
        }

        $them_slideshow = new SlideShow();
        $them_slideshow->ten = $ten;
        $them_slideshow->mo_ta = $mo_ta;
        $them_slideshow->trang_thai = $trang_thai;

        // Xử lý thông tin hình ảnh
        $originName = $data_slideshow->getClientOriginalName();
        $fileName = pathinfo($originName, PATHINFO_FILENAME);
        $extension = $data_slideshow->getClientOriginalExtension();
        // thuộc tính trong cột
        $ten_file = $fileName . time() . '.' . $extension;
        $them_slideshow->duong_dan = 'assets/img/img_slideshow/' . $ten_file;
        $data_slideshow->move(public_path('assets/img/img_slideshow'), $ten_file);
        $them_slideshow->save();

        if($them_slideshow){
            return response()->json([
                'status' => 'success',
                'message' => 'Thêm SlideShow Mới Thành Công!'
            ], 200);
        }
        return response()->json([
            'status' => 'error',
            'message' => 'Thêm SlideShow Mới Thất Bại!'
        ], 200); 
    }

    // Xóa slideshow
    public function xoaSlideShow($id)
    {
        try {
            $xoa_slideshow =  SlideShow::find($id);
            $duong_dan_slideshow = public_path().'/'.$xoa_slideshow->duong_dan;
            File::delete($duong_dan_slideshow);
            $xoa_slideshow->delete();
            $dsSlideShow = SlideShow::queryDSSlideShow([])->paginate(25);
            $giao_dien_bang =  view('admin.slideshow.bang-slideshow', compact(['dsSlideShow']))->render();
            return response()->json([
                'status' => 'success',
                'message' => 'Xóa SlideShow Thành Công!',
                'giao_dien_bang' => $giao_dien_bang,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Xóa SlideShow Thất Bại!'
            ], 200);
        }
    }

    // Chi tiết slideshow
    public function chiTietSlideShow($slug, $id){
        $timSlideShow = SlideShow::find($id);
        $ten_file = last(explode('/', $timSlideShow->duong_dan));
        $thongBaoMoi = ThongBao::queryDSTrongBayNgay()->get();
        return view('admin.slideshow.cap-nhat-slideshow',compact(['timSlideShow', 'ten_file', 'thongBaoMoi']));
    }

    // Cập nhật slideshow
    public function capNhatSlideShow(Request $request, $id)
    {
        $ten                = $request->ten;
        $mo_ta              = $request->mo_ta;
        $trang_thai         = $request->trang_thai;
        $sua_slideshow      = SlideShow::where('id',$request->id)->first();
     
        $checkTen = SlideShow::where([['ten',$ten],['id','!=',$id]])->first();
        if($checkTen){
            return response()->json([
                'status'=>'error',
                'message'=>'Tên SlideShow Đã Tồn Tại!'
            ],200);
        }
        else {
                // Xóa slideshow thay đổi
                $data_add_slideshow = $request->data_add_slideshow;
                if(!empty($data_add_slideshow)){
                    $delete_file_slideshow = public_path().'/'.$sua_slideshow->duong_dan;
                    File::delete($delete_file_slideshow);
                }
                // Cập nhật slideshow
                $sua_slideshow->ten = $ten;
                $sua_slideshow->mo_ta = $mo_ta;
                $sua_slideshow->trang_thai = $trang_thai;
                if(!empty($data_add_slideshow)){
                    // Lưu slideshow mới
                    // Xử lý thông tin hình ảnh
                    $originName = $data_add_slideshow->getClientOriginalName();
                    $fileName = pathinfo($originName, PATHINFO_FILENAME);
                    $extension = $data_add_slideshow->getClientOriginalExtension();
                    // thuộc tính trong cột
                    $ten_file_slideshow = $fileName . time() . '.' . $extension;
                    $sua_slideshow->duong_dan = 'assets/img/img_slideshow/' . $ten_file_slideshow;
                    $data_add_slideshow->move(public_path('assets/img/img_slideshow'), $ten_file_slideshow);
                }
                $sua_slideshow->save();

                return response()->json([
                    'status' => 'success',
                    'message' => 'Cập Nhật SlideShow Thành Công!'
                ], 200);
            }
        return response()->json([
            'status' => 'error',
            'message' => 'Cập Nhật SlideShow Thất Bại!'
        ], 200);
    }
}
