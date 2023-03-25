<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sach;
use Carbon\Carbon;

class SachController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list_sach = Sach::orderBy('id','DESC')->get();
        return view('admincp.sach.index',compact('list_sach'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admincp.sach.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'tensach'=>'required|unique:sach|max:255',
            'slug_sach'=>'required|unique:sach|max:255',
            'hinhanh'=>'required',
            // |image|mines:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=100,
            // max_height=100',
            'tomtat'=>'required|max:255',
            // 'tacgia'=>'required|max:255',
            'kichhoat'=>'required',
            'noidung'=>'required',
            // 'danhmuc'=>'required',
            // 'sachnoibat'=>'required',
            // 'theloai'=>'required',
            // 'tinhtrang'=>'required',
            'views'=>'required',
            'tukhoa'=>'required',
        ],[
            'tensach.unique'=>'Tên truyện đã có nhé, xin điền tên khác',
            'slug_sach.unique'=>'Slug truyện đã có nhé, xin điền slug khác',
            'tensach.required'=>'Tên truyện phải có nhé',
            'tomtat.required'=>'Mô tả truyện phải có nhé',
            // 'tacgia.required'=>'Tác giả truyện phải có nhé',
            'slug_sach.required'=>'Slug truyện phải có nhé',
            'hinhanh.required'=>'Hình ảnh truyện phải có nhé',
            'tukhoa.required'=>'Từ khóa truyện phải có nhé',
            'views.required'=>'Yêu cầu nhập lượt xem',
            'noidung.required'=>'Yêu cầu nhập nội dung'
        ]);
        $sach = new Sach();
        $sach->tensach = $request->tensach;
        $sach->slug_sach = $request->slug_sach;
        $sach->tomtat = $request->tomtat;
        $sach->noidung = $request->noidung;
        $sach->kichhoat = $request->kichhoat;
        $sach->views = $request->views;
        $sach->tukhoa = $request->tukhoa;
        $sach->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $sach->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        if($request->file('hinhanh')){
            $file= $request->file('hinhanh');
            $filename = $file->getClientOriginalName();
            $file-> move(public_path('uploads/sach'), $filename);
            $sach['hinhanh']= $filename;
        }

        $sach->save();
        return redirect()->back()->with('status','Thêm sách thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sach = Sach::find($id);
        return view('admincp.sach.edit',compact('sach'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'tensach'=>'required|max:255',
            'slug_sach'=>'required|max:255',
            // 'hinhanh'=>'required',
            // |image|mines:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=100,
            // max_height=100',
            'tomtat'=>'required|max:255',
            // 'tacgia'=>'required|max:255',
            'kichhoat'=>'required',
            'noidung'=>'required',
            // 'danhmuc'=>'required',
            // 'sachnoibat'=>'required',
            // 'theloai'=>'required',
            // 'tinhtrang'=>'required',
            'views'=>'required',
            'tukhoa'=>'required',
        ],[
            // 'tensach.unique'=>'Tên truyện đã có nhé, xin điền tên khác',
            // 'slug_sach.unique'=>'Slug truyện đã có nhé, xin điền slug khác',
            'tensach.required'=>'Tên truyện phải có nhé',
            'tomtat.required'=>'Mô tả truyện phải có nhé',
            // 'tacgia.required'=>'Tác giả truyện phải có nhé',
            'slug_sach.required'=>'Slug truyện phải có nhé',
            // 'hinhanh.required'=>'Hình ảnh truyện phải có nhé',
            'tukhoa.required'=>'Từ khóa truyện phải có nhé',
            'views.required'=>'Yêu cầu nhập lượt xem',
            'noidung.required'=>'Yêu cầu nhập nội dung'
        ]);
        $sach = Sach::find($id);
        $sach->tensach = $request->tensach;
        $sach->slug_sach = $request->slug_sach;
        $sach->tomtat = $request->tomtat;
        $sach->noidung = $request->noidung;
        $sach->kichhoat = $request->kichhoat;
        $sach->views = $request->views;
        $sach->tukhoa = $request->tukhoa;
        $sach->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $sach->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        if($request->file('hinhanh')){
            $file= $request->file('hinhanh');
            $filename = $file->getClientOriginalName();
            $file-> move(public_path('uploads/sach'), $filename);
            $sach['hinhanh']= $filename;
        }

        $sach->save();
        return redirect()->back()->with('status','Thêm sách thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sach =  Sach::find($id);
        $path = 'public/uploads/sach/';
        if($sach->hinhanh != NULL){
            unlink($path.$sach->hinhanh);
        }
        Sach::find($id)->delete();
        return redirect()->back()->with('status','Xóa sách thành công');
    }
}
