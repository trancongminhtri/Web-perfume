<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DanhMucSanPham extends Model
{
    use SoftDeletes;
    protected $table = 'danh_muc_san_pham';

    public function scopeQueryDSDanhMucTangDan($query){
        return $query->orderBy('ten_danh_muc');
    }

    public function scopeQueryDSDanhMuc($query, $req){
        if(!empty($req['ten_danh_muc'])){
            $query->where('ten_danh_muc', 'like', "%{$req['ten_danh_muc']}%");
        }
        return $query->orderBy('created_at', 'desc');
    }

    public function scopeQueryCapNhapNuocHoa($query, $id){
        $query  ->rightJoin('nuoc_hoa', 'danh_muc_san_pham.id', '=', 'nuoc_hoa.danh_muc_id')
                ->where('danh_muc_san_pham.id', $id)
                ->update(['nuoc_hoa.danh_muc_id' => null]);
        return $query;
    }
}
