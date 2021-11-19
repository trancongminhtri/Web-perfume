<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ThuongHieu extends Model
{
    use SoftDeletes;
    protected $table = 'thuong_hieu';

    public function scopeQueryDSThuongHieu($query, $req){
        if(!empty($req['ten_thuong_hieu'])){
            $query->where('ten_thuong_hieu', 'like', "%{$req['ten_thuong_hieu']}%");
        }
        return $query->orderBy('ten_thuong_hieu');
    }

    public function scopeQueryDSThuongHieuTangDan($query){
        return $query->orderBy('ten_thuong_hieu');
    }
}
