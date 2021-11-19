<?php

namespace App\Http\Controllers;

use App\TrangTinh;
use Illuminate\Http\Request;
use App\ThongBao;

class TrangBlogController extends Controller
{
    public function trangDanhSachBlog()
    {
        $dsBlog = TrangTinh::queryDSBlogTangDan()->get();
        $dsBlogRandom = TrangTinh::queryDSBlogRandom()->inRandomOrder()->limit(5)->get();
        $thongBaoMoi = ThongBao::queryDSTrongBayNgay()->get();
        return view('blog.trang-blog', compact(['dsBlog', 'dsBlogRandom', 'thongBaoMoi']));
    }

    public function xemThemBlog(Request $request)
    {
        if ($request->ajax()) {
            $lastId = '';
            $minId = TrangTinh::min('id');
            if ($minId < $request->last_id) {
                $dsBlog = TrangTinh::queryDSBlogXemThem($request->last_id)->get();
                if(count($dsBlog) != 0){
                    return view('blog.blog', compact(['dsBlog', 'lastId']));
                }
                return; 
            }
        }
    }
}
