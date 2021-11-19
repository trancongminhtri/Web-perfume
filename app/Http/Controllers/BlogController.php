<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use Exception;
use Illuminate\Http\Request;
use App\TrangTinh;
use App\Http\Requests\BlogRequest;
use App\Http\Requests\CapNhatBlogRequest;
use App\ThongBao;

class BlogController extends Controller
{
    public function quanlyBlog(Request $request) {
        $arrKey = ['tieu_de_blog'];
        $inputSearch = [];
        foreach($arrKey as $key => $value) {
            $inputSearch[$value] = $request[$value];
        }
        $lastId = '';
        $dsBlog = TrangTinh::queryDanhSachBlog($request->toArray())->paginate(25);
        $thongBaoMoi = ThongBao::queryDSTrongBayNgay()->get();
        return view('admin.blog.danh-sach-blog', compact(['inputSearch', 'dsBlog', 'thongBaoMoi', 'lastId']));
    }

    // Trang thêm blog
    public function trangThemBlog() {
        $thongBaoMoi = ThongBao::queryDSTrongBayNgay()->get();
        return view('admin.blog.them-blog', compact(['thongBaoMoi']));
    }
    
    // Thêm blog
    public function themBlog(BlogRequest $request) {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $tieu_de         = $request -> tieu_de_blog; 
        $mo_ta_noi_dung  = $request -> mo_ta_blog; 
        $noi_dung        = $request -> noi_dung_blog;  
        $data_blog       = $request -> data_blog;
        $trang_thai      = $request -> trang_thai_blog; 
       
        $check_tieu_de = TrangTinh::where('tieu_de', $tieu_de)->first();

        if($check_tieu_de) {
            return response()->json ([
                'status' => 'error',
                'message' => 'Tiêu Đề Trang Tĩnh Đã Tồn Tại!'
            ], 200);
        }

        $them_blog = new TrangTinh();
        $them_blog->tieu_de        = $tieu_de;
        $them_blog->mo_ta_noi_dung = $mo_ta_noi_dung;
        $them_blog->noi_dung       = $noi_dung;
        $them_blog->trang_thai     = $trang_thai;

        // Xử lý hình ảnh
        $originName = $data_blog->getClientOriginalName();
        // Lấy tên file
        $fileName =  pathinfo($originName, PATHINFO_FILENAME);
        // Lấy đuôi hình ảnh (png, jpg)
        $extension = $data_blog->getClientOriginalExtension();

        // thuộc tính trong cột db
        $ten_file = $fileName . time() . '.' . $extension;
        $them_blog ->duong_dan = 'assets/img/img_blog/' . $ten_file;
        $data_blog->move(public_path('assets/img/img_blog/'), $ten_file);
        $them_blog->save();

        if($them_blog) {
            return response() ->json([
                'status' => 'success',
                'message' => 'Thêm Trang Tĩnh Mới Thành Công!'
            ], 200);

        }
        return response() ->json([
                'status' => 'error',
                'message' => 'Thêm Trang Tĩnh Mới Thất Bại!'
            ], 200);
    }

    // Chi tiết Blog 
    public function chiTietBlog($slug, $id) {
        $searchBlog = TrangTinh::find($id);
        $nameFile = last(explode('/', $searchBlog->duong_dan));
        $thongBaoMoi = ThongBao::queryDSTrongBayNgay()->get();
        return view('admin.blog.cap-nhat-blog', compact(['searchBlog', 'nameFile', 'thongBaoMoi']));
    }

    // Cập nhật Blog
    public function capNhatBlog(CapNhatBlogRequest $request, $id) {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $tieu_de         = $request->tieu_de_blog;
        $mo_ta_noi_dung  = $request -> mo_ta_blog; 
        $noi_dung        = $request->noi_dung_blog;
        $trang_thai      = $request->trang_thai_blog;
        $cap_nhat_blog   = TrangTinh::where('id', $request->id)->first();


        $checkTieuDe = TrangTinh::where([['tieu_de', $tieu_de],['id','!=', $id]])->first();
        if($checkTieuDe) {
            return response()->json ([
                'status' => 'error',
                'message' => 'Tiêu Đề Trang Tĩnh Đã Tồn Tại!'
            ], 200);
        } 
        else {
            // Xóa thay đổi hỉnh ảnh
            $add_data_blog = $request->data_blog;
            if(!empty($add_data_blog)) {
                $delete_file_blog = public_path().'/'.$cap_nhat_blog->duong_dan;
                    File::delete($delete_file_blog);
            }
            // Cập nhật blog
            $cap_nhat_blog->tieu_de          = $tieu_de;
            $cap_nhat_blog->mo_ta_noi_dung   = $mo_ta_noi_dung;
            $cap_nhat_blog->noi_dung         = $noi_dung;
            $cap_nhat_blog->trang_thai       = $trang_thai;

            if(!empty($add_data_blog)) {
                // Xử lý hình ảnh
                $originName = $add_data_blog->getClientOriginalName();
                // Lấy tên file
                $fileName =  pathinfo($originName, PATHINFO_FILENAME);
                // Lấy đuôi hình ảnh (png, jpg)
                $extension =$add_data_blog->getClientOriginalExtension();

                // thuộc tính trong cột db
                $ten_file_blog = $fileName . time() . '.' . $extension;
                $cap_nhat_blog ->duong_dan = 'assets/img/img_blog/' .$ten_file_blog;
                $add_data_blog->move(public_path('assets/img/img_blog/'), $ten_file_blog);
            }
            $cap_nhat_blog->save();

                return response() ->json([
                    'status' => 'success',
                    'message' => 'Cập Nhật Trang Tĩnh Thành Công!'
                ], 200);
            }
            return response() ->json([
                    'status' => 'error',
                    'message' => 'Cập Nhật Trang Tĩnh Mới Thất Bại!'
                ], 200);
    }

    // Xóa blog
    public function xoaBlog($id) {
        try {
            $xoa_blog =  TrangTinh::find($id);
            $duong_dan_blog = public_path().'/'.$xoa_blog->duong_dan;
            File::delete($duong_dan_blog);
            $xoa_blog->delete();
            $dsBlog = TrangTinh::queryDanhSachBlog([])->paginate(25);
            $giao_dien_bang =  view('admin.blog.bang-blog', compact(['dsBlog']))->render();
            return response()->json([
                'status' => 'success',
                'message' => 'Xóa Trang Tĩnh Thành Công!',
                'giao_dien_bang' => $giao_dien_bang,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Xóa Trang Tĩnh Thất Bại!'
            ], 200);
        }
    }
}