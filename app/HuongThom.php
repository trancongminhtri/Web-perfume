<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HuongThom extends Model
{
    use SoftDeletes;
    protected $table = 'huong_thom';

    public function scopeQueryDSHuongThom($query, $req){
        if(!empty($req['ten_huong_thom'])){
            $query->where('ten_huong_thom', 'like', "%{$req['ten_huong_thom']}%");
        }
        return $query->orderBy('ten_huong_thom');
    }

    public function scopeQueryDSHuongThomTangDan($query){
        return $query->orderBy('ten_huong_thom');
    }
}
