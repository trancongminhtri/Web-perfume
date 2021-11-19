<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DonHang;
use Carbon\Carbon;
use App\ChiTietDonHang;
use App\Http\Requests\NgayThongKeRequest;
use App\ThongBao;

class BaoCaoThongKeController extends Controller
{
    // Trả về trang báo cáo thống kê ngày hiện tại
    public function trangBaoCaoThongKe(NgayThongKeRequest $request)
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
        $date = [
            'hom-nay' => [
                'fromDay' => Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d'),
                'toDay' => Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d'),
            ],
            'hom-qua' => [
                'fromDay' => Carbon::yesterday('Asia/Ho_Chi_Minh')->format('Y-m-d'),
                'toDay' => Carbon::yesterday('Asia/Ho_Chi_Minh')->format('Y-m-d'),
            ],
            'tuan-nay' => [
                'fromDay' => Carbon::now('Asia/Ho_Chi_Minh')->startOfWeek()->toDateString(),
                'toDay' => Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d'),
            ],
            'thang-nay' => [
                'fromDay' => Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString(),
                'toDay' => Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d'),
            ],
            'nam-nay' => [
                'fromDay' => Carbon::now('Asia/Ho_Chi_Minh')->startOfYear()->toDateString(),
                'toDay' => Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d'),
            ]
        ];

        $arr_date = [
            'tu_ngay' => $now,
            'den_ngay' => $now,
        ];
        if (!empty($request->from_date) && !empty($request->to_date)) {
            $arr_date = [
                'tu_ngay' => $request->from_date,
                'den_ngay' => $request->to_date,
            ];
        };
        if (!empty($request->thoi_gian) && $request->thoi_gian != 'chon') {
            $arr_date = [
                'tu_ngay' => $date[$request->thoi_gian]['fromDay'],
                'den_ngay' => $date[$request->thoi_gian]['toDay'],
            ];
        };

        // Đơn hàng hoàn thành trong ngày hiện tại
        $DHHoanThanh = DonHang::queryHoanThanhNgayHienTai($arr_date)->get();
        // Danh sách nước hoa của đơn hàng hoàn thành trong ngày hiện tại
        $dsNuocHoaHoanThanh = ChiTietDonHang::queryHoanThanhNgayHienTai($arr_date)->paginate(10);

        $thongKeDHHoanThanh = [
            'tong_thanh_toan' =>  $DHHoanThanh->sum('tong_thanh_toan'),
            'tong_san_pham' =>  $DHHoanThanh->sum('tong_so_luong'),
            'tong_don_hang' =>  $DHHoanThanh->count('id'),
        ];

        $doanhThuDHHoanThanh = [
            'thuc_te' =>  $DHHoanThanh->sum('tong_thanh_toan'),
            'giam_gia' =>  $DHHoanThanh->sum('tong_tien_giam'),
            'truoc_giam_gia' =>  $DHHoanThanh->sum('tong_tien'),
        ];

        // Đơn hàng chưa hoàn thành
        $DHMoi = DonHang::queryDHMoiNgayHienTai($arr_date)->get();
        $dsNuocHoaDHMoi = ChiTietDonHang::queryDHMoiNgayHienTai($arr_date)->paginate(10);

        $thongKeDHMoi = [
            'tong_thanh_toan' =>  $DHMoi->where('trang_thai_id', '!=', 4)->sum('tong_thanh_toan'),
            'tong_san_pham' =>  $DHMoi->where('trang_thai_id', '!=', 4)->sum('tong_so_luong'),
            'tong_don_hang' =>  $DHMoi->count('id'),
        ];

        $doanhThuDHMoi = [
            'thuc_te' =>  $DHMoi->where('trang_thai_id', '!=', 4)->sum('tong_thanh_toan'),
            'giam_gia' =>  $DHMoi->where('trang_thai_id', '!=', 4)->sum('tong_tien_giam'),
            'truoc_giam_gia' =>  $DHMoi->where('trang_thai_id', '!=', 4)->sum('tong_tien'),
        ];

        $trangThaiDHMoi = [
            'dang_xu_ly' =>  $DHMoi->where('trang_thai_id', '=', 1)->count('id'),
            'da_xu_ly' =>  $DHMoi->where('trang_thai_id', '=', 2)->count('id'),
            'da_huy' =>  $DHMoi->where('trang_thai_id', '=', 4)->count('id'),
        ];

        $doanhThuDHHuy = [
            'thuc_te' =>  $DHMoi->where('trang_thai_id', '=', 4)->sum('tong_thanh_toan'),
            'giam_gia' =>  $DHMoi->where('trang_thai_id', '=', 4)->sum('tong_tien_giam'),
            'truoc_giam_gia' =>  $DHMoi->where('trang_thai_id', '=', 4)->sum('tong_tien'),
        ];

        $thongBaoMoi = ThongBao::queryDSTrongBayNgay()->get();

        return view(
            'admin.bao-cao.bao-cao-thong-ke',
            compact([
                'thongKeDHHoanThanh', 'doanhThuDHHoanThanh', 'dsNuocHoaHoanThanh', 'dsNuocHoaDHMoi',
                'thongKeDHMoi', 'doanhThuDHMoi', 'trangThaiDHMoi', 'doanhThuDHHuy', 'now', 'thongBaoMoi'
            ])
        );
    }

    public function phanTrangThongKe(Request $request)
    {
        if ($request->ajax()) {
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $now = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
            $date = [
                'hom-nay' => [
                    'fromDay' => Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d'),
                    'toDay' => Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d'),
                ],
                'hom-qua' => [
                    'fromDay' => Carbon::yesterday('Asia/Ho_Chi_Minh')->format('Y-m-d'),
                    'toDay' => Carbon::yesterday('Asia/Ho_Chi_Minh')->format('Y-m-d'),
                ],
                'tuan-nay' => [
                    'fromDay' => Carbon::now('Asia/Ho_Chi_Minh')->startOfWeek()->toDateString(),
                    'toDay' => Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d'),
                ],
                'thang-nay' => [
                    'fromDay' => Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString(),
                    'toDay' => Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d'),
                ],
                'nam-nay' => [
                    'fromDay' => Carbon::now('Asia/Ho_Chi_Minh')->startOfYear()->toDateString(),
                    'toDay' => Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d'),
                ]
            ];

            $arr_date = [
                'tu_ngay' => $now,
                'den_ngay' => $now,
            ];
            if (!empty($request->from_date) && !empty($request->to_date)) {
                $arr_date = [
                    'tu_ngay' => $request->from_date,
                    'den_ngay' => $request->to_date,
                ];
            };
            if (!empty($request->thoi_gian) && $request->thoi_gian != 'chon') {
                $arr_date = [
                    'tu_ngay' => $date[$request->thoi_gian]['fromDay'],
                    'den_ngay' => $date[$request->thoi_gian]['toDay'],
                ];
            };
            $dsNuocHoaHoanThanh = ChiTietDonHang::queryHoanThanhNgayHienTai($arr_date)->paginate(10);
            $dsNuocHoaDHMoi = ChiTietDonHang::queryDHMoiNgayHienTai($arr_date)->paginate(10);
            $nuoc_hoa_ht = view('admin.bao-cao.nuoc-hoa-hoan-thanh', compact(['dsNuocHoaHoanThanh']))->render();
            $nuoc_hoa_khac = view('admin.bao-cao.nuoc-hoa-khac', compact(['dsNuocHoaDHMoi']))->render();
            return response()->json([
                'nuoc_hoa_ht' => $nuoc_hoa_ht,
                'nuoc_hoa_khac' => $nuoc_hoa_khac,
            ]);
        }
    }
}
