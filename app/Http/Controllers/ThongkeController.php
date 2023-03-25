<?php

namespace App\Http\Controllers;

use App\Models\DanhmucTruyen;
use App\Models\Truyen;
use App\Models\Chapter;
use App\Models\User;
use App\Models\Theloai;
use App\Models\Sach;
use Storage;
use App\Models\Info;
use App\Models\Thongke;
use App\Models\User_Custom;
use Illuminate\Http\Request;

class ThongkeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $count = Truyen::with('id_truyen')->count();
        $count_danhmuc = DanhmucTruyen::with('id_danhmuc')->count();
        $count_theloai = Theloai::with('id')->count();
        $count_sach = Sach::with('id')->count();
        $count_nhanvien = User::with('role_as')->where('role_as', 2)->count();
        $count_khachhang = User::with('role_as')->where('role_as', 0)->count();
        // $thongke_truyen = Truyen::truyen->get()->groupBy('id_truyen');
        return view('admincp.thongke.index',compact('count','count_danhmuc','count_theloai','count_sach','count_nhanvien','count_khachhang'));
    }
    public function thongkenhanvien()
    {
        $list_nhanvien = User::orderBy('id','DESC')->get();
        return view('admincp.nhanvien.index',compact('list_nhanvien'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $list_nhanvien = User::orderBy('id','DESC')->where('role_as', 2)->get();
        return view('admincp.nhanvien.index',compact('list_nhanvien'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $list_nhanvien = User::orderBy('id','DESC')->where('role_as', 0)->get();
        return view('admincp.nhanvien.xem',compact('list_nhanvien'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Thongke  $thongke
     * @return \Illuminate\Http\Response
     */
    public function show(Thongke $thongke)
    {
      
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Thongke  $thongke
     * @return \Illuminate\Http\Response
     */
    public function edit(Thongke $thongke)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Thongke  $thongke
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Thongke $thongke)
    {
        $list_nhanvien = User::orderBy('id','DESC')->where('role_as', 0)->get();
        return view('admincp.nhanvien.xem',compact('list_nhanvien'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Thongke  $thongke
     * @return \Illuminate\Http\Response
     */
    public function destroy(Thongke $thongke)
    {
        //
    }
    public function thongketruyen()
    {
        // $thongke_truyen = Truyen::with('danhmuctruyen','theloai')->groupBy('id_truyen','DESC')->get();
        // return view('admincp.thongke.thongkedanhmuc',compact('thongke_truyen'));
    }

}
