<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Truyen extends Model
{
    use HasFactory;
    protected $dates =[
        'created_at',
        'updated_at'
    ];
    public $timestamps = false;
    protected $fillable = [
        'tentruyen', 'tomtat', 'kichhoat', 'slug_truyen','hinhanh', 'id_danhmuc','theloai_id','tinhtrang','tukhoa','created_at', 'updated_at','truyen_noibat'
    ];
    protected $primaryKey = 'id_truyen';
    protected $table = 'truyen';
    public function danhmuctruyen(){
        return $this->belongsTo('App\Models\DanhmucTruyen','id_danhmuc','id_danhmuc');
    }
    public function chapter(){
        return $this->hasMany('App\Models\Chapter');
    }
    public function theloai(){
        return $this->belongsTo('App\Models\Theloai','theloai_id','id');
    }
    public function thuocnhieudanhmuctruyen(){
        return $this->belongsToMany(DanhmucTruyen::class,'thuocdanh','id_truyen','id_danhmuc');
    }
    public function thuocnhieutheloaitruyen(){
        return $this->belongsToMany(Theloai::class,'thuocloai','id_truyen','theloai_id');
    }


}
