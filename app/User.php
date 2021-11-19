<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    protected $table = 'nguoi_dung';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function scopeQueryList($query, $req, $id){
        if(!empty($req['email'])){
            $query->where('email', 'like', "%{$req['email']}%");
        }
        if(!empty($req['sdt'])){
            $query->where('sdt', 'like', "%{$req['sdt']}%");
        }
        if(!empty($req['chuc_vu'])){
            $query->where('chuc_vu', 'like', "%{$req['chuc_vu']}%");
        }
        return $query   ->where([
                                    ['id', '!=' ,$id],
                                    ['id', '!=', 1],
                                ])
                        ->orderBy('ho_ten');
    }
}
