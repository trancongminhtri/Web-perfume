<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NhaCungCap extends Model
{
    use SoftDeletes;
    protected $table = 'nha_cung_cap';

    public function scopeQueryDSNCC($query, $req){
        if(!empty($req['ten_ncc'])){
            $query->where('ten_ncc', 'like', "%{$req['ten_ncc']}%");
        }
        return $query->orderBy('ten_ncc');
    }

    public function scopeQueryDSNCCTangDan($query){
        return $query->orderBy('id');
    }
}
