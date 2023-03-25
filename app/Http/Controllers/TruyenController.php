<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\DanhmucTruyen;
use App\Models\Truyen;
use App\Models\Theloai;
use App\Models\Chapter;
use Illuminate\Support\Facades\Validator;
class TruyenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list_truyen = Truyen::with('danhmuctruyen','theloai')->orderBy('id_danhmuc','DESC')->get();
        return view('admincp.truyen.index',compact('list_truyen'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $theloai = Theloai::orderBy('id','DESC')->get();
        $danhmuc = DanhmucTruyen::orderBy('id_danhmuc','DESC')->get();
        return view('admincp.truyen.create')->with(compact('danhmuc','theloai'));
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
            'tentruyen'=>'required|unique:truyen|max:255',
            'slug_truyen'=>'required|unique:truyen|max:255',
            'hinhanh'=>'required',
            // |image|mines:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=100,
            // max_height=100',
            'tomtat'=>'required|max:255',
            'tacgia'=>'required|max:255',
            'kichhoat'=>'required',
            'danhmuc'=>'required',
            'truyennoibat'=>'required',
            'theloai'=>'required',
            'tinhtrang'=>'required',
            'tukhoa'=>'required',
        ],[
            'tentruyen.unique'=>'Tên truyện đã có nhé, xin điền tên khác',
            'slug_truyen.unique'=>'Slug truyện đã có nhé, xin điền slug khác',
            'tentruyen.required'=>'Tên truyện phải có nhé',
            'tomtat.required'=>'Mô tả truyện phải có nhé',
            'tacgia.required'=>'Tác giả truyện phải có nhé',
            'slug_truyen.required'=>'Slug truyện phải có nhé',
            'hinhanh.required'=>'Hình ảnh truyện phải có nhé',
            'tukhoa.required'=>'Từ khóa truyện phải có nhé'
        ]);
        $truyen = new Truyen();
        $truyen->tentruyen = $request->tentruyen;
        $truyen->slug_truyen = $request->slug_truyen;
        $truyen->theloai_id = $request->theloai;
        $truyen->tomtat = $request->tomtat;
        $truyen->tacgia = $request->tacgia;
        $truyen->id_danhmuc = $request->danhmuc;
        $truyen->kichhoat = $request->kichhoat;
        $truyen->tinhtrang = $request->tinhtrang;
        $truyen->truyen_noibat = $request->truyennoibat;
        $truyen->tukhoa = $request->tukhoa;
        $truyen->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        if($request->file('hinhanh')){
            $file= $request->file('hinhanh');
            $filename = $file->getClientOriginalName();
            $file-> move(public_path('uploads/truyen'), $filename);
            $truyen['hinhanh']= $filename;
        }

        $truyen->save();
        return redirect()->back()->with('status','Thêm truyện truyện thành công');
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
         // $list_truyen = Truyen::all();

         $truyen = Truyen::find($id);
         $theloai = Theloai::orderBy('id','DESC')->get();
         $danhmuc = DanhmucTruyen::orderBy('id_danhmuc','DESC')->get();
         // dd($list_truyen);
         return view('admincp.truyen.edit',compact('truyen','danhmuc','theloai'));
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
            'tentruyen'=>'required|max:255',
            'slug_truyen'=>'required|max:255',
            'tomtat'=>'required|max:255',
            'tacgia'=>'required|max:255',
            'kichhoat'=>'required',
            'truyennoibat'=>'required',
            'danhmuc'=>'required',
            'theloai'=>'required',
            'tukhoa'=>'required',
            'tinhtrang'=>'required',
        ],[
            // 'tentruyen.unique'=>'Tên truyện đã có nhé, xin điền tên khác',
            // 'slug_truyen.unique'=>'Slug truyện đã có nhé, xin điền slug khác',
            'tentruyen.required'=>'Tên truyện phải có nhé',
            'tomtat.required'=>'Mô tả truyện phải có nhé',
            'tacgia.required'=>'Tác giả truyện phải có nhé',
            'slug_truyen.required'=>'Slug truyện phải có nhé',
            'tukhoa.required'=>'Từ khóa phải có nhé',
        ]);
        $truyen = Truyen::find($id);
        $truyen->tentruyen = $request->tentruyen;
        $truyen->slug_truyen = $request->slug_truyen;
        $truyen->theloai_id = $request->theloai;
        $truyen->tomtat = $request->tomtat;
        $truyen->tacgia = $request->tacgia;
        $truyen->id_danhmuc = $request->danhmuc;
        $truyen->kichhoat = $request->kichhoat;
        $truyen->tukhoa = $request->tukhoa;
        $truyen->truyen_noibat = $request->truyennoibat;
        $truyen->tinhtrang = $request->tinhtrang;
        $truyen->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        if($request->file('hinhanh')){
            $file= $request->file('hinhanh');
            $filename = $file->getClientOriginalName();
            $file-> move(public_path('uploads/truyen'), $filename);
            $truyen['hinhanh']= $filename;
        }

        $truyen->save();
        return redirect()->back()->with('status','Cập nhật truyện thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $truyen =  Truyen::find($id);
        $path = 'public/uploads/truyen/';
        if($truyen->hinhanh != NULL){
            unlink($path.$truyen->hinhanh);
        }
        Truyen::find($id)->delete();
        Chapter::where('id_truyen',$id)->delete();
        return redirect()->back()->with('status','Xóa truyện thành công');
    }
    public function truyennoibat(Request $request){
        $data = $request->all();
        $truyen = Truyen::find($data['truyen_id']);
        $truyen->truyen_noibat = $data['truyennoibat'];
        $truyen->save();
    }

}
