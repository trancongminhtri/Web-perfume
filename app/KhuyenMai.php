<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class KhuyenMai extends Model
{
    use SoftDeletes;
    protected $table = 'khuyen_mai';

    public function scopeQueryDSKhuyenMaiTangDan($query){
        return $query->orderBy('ten_khuyen_mai');
    }

    public function scopeQueryDSKhuyenMai($query, $req){
        if(!empty($req['ten_khuyen_mai'])){
            $query->where('ten_khuyen_mai', 'like', "%{$req['ten_khuyen_mai']}%");
        }
        return $query->orderBy('ngay_bat_dau', 'asc');
    }

    public function scopeQueryCapNhapNuocHoa($query, $id){
        $query  ->rightJoin('nuoc_hoa', 'khuyen_mai.id', '=', 'nuoc_hoa.khuyen_mai_id')
                ->where('khuyen_mai.id', $id)
                ->update(['nuoc_hoa.khuyen_mai_id' => null]);
        return $query;
    }

    // Xóa mã khuyến mãi trong bảng nước hoa khi khuyến mãi hết hạn
    public function scopeQueryXoaMaKhuyenMai($query){
        $query  ->rightJoin('nuoc_hoa', 'khuyen_mai.id', '=', 'nuoc_hoa.khuyen_mai_id')
                ->where([
                            ['khuyen_mai.ngay_ket_thuc', '<=', Carbon::now('Asia/Ho_Chi_Minh')],
                            ['nuoc_hoa.khuyen_mai_id', '!=', null],
                        ]);
        return $query;
    }
}
