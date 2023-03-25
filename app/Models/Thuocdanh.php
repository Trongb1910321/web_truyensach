<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Theloai extends Model
{
    use HasFactory;
    public $timestamps = false;
    // protected $fillable = [

    // ];
    protected $primaryKey = 'id';
    protected $table = 'thuocdanh';

    public function truyen()
    {
       return $this->hasMany('App\Models\Truyen');
    }
}
