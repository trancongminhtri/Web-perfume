<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ThongBao;
use App\ChiTietPhieuNhap;
use App\PhieuNhap;
use Illuminate\Support\Str;
class ChiTietPhieuNhapController extends Controller
{
    public function chiTietPhieuNhap(Request $request, $id) {

        $thongBaoMoi = ThongBao::queryDSTrongBayNgay()->get();
        $timPhieuNhap = PhieuNhap::queryPhieuNhapTheoID($id)->get();
        $timChiTietPhieuNhap = ChiTietPhieuNhap::queryChiTietPhieuNhapThepIDPhieuNhap($id)->get();

        return view('admin.phieu-nhap.chi-tiet-phieu-nhap', compact(['thongBaoMoi', 'timPhieuNhap', 'timChiTietPhieuNhap']));
    }
}
