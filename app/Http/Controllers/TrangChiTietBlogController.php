<?php

namespace App\Http\Controllers;

use App\TrangTinh;
use Illuminate\Http\Request;

class TrangChiTietBlogController extends Controller
{
    public function trangChiTietBlog($slug, $id) {
        // $searchIdBlog = TrangTinh::QueryDSBlogOfChiTiet($id);
        $searchIdBlog = TrangTinh::find($id);
        return view('blog.chi-tiet-blog', compact(['searchIdBlog']));
    }
}
