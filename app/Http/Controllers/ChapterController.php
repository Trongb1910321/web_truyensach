<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chapter;
use App\Models\Truyen;

class ChapterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $chapter = Chapter::with('truyen')->orderBy('id_truyen','DESC')->get();
        return view('admincp.chapter.index')->with(compact('chapter'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $truyen = Truyen::orderBy('id_truyen','DESC')->get();
        return view('admincp.chapter.create')->with(compact('truyen'));
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
            'tieude'=>'required|unique:chapter|max:255',
            'slug_chapter'=>'required|unique:chapter|max:255',
            'noidung'=>'required',
            'tomtat'=>'required',
            'kichhoat'=>'required',
            'id_truyen'=>'required'
        ],[
            'slug_chapter.unique'=>'Slug đã có nhé, xin điền tên khác',
            'tieude.unique'=>'Tiêu đề đã có nhé, xin điền slug khác',
            'tieude.required'=>'Tiêu đề phải có nhé',
            'tomtat.required'=>'Tóm tắt truyện phải có nhé',
            'noidung.required'=>'Nội dung truyện phải có nhé',
            'slug_chapter.required'=>'Slug chapter phải có nhé',
        ]);
        $chapter = new Chapter();
        $chapter->tieude = $request->tieude;
        $chapter->slug_chapter = $request->slug_chapter;
        $chapter->tomtat = $request->tomtat;
        $chapter->noidung = $request->noidung;
        $chapter->id_truyen = $request->id_truyen;
        $chapter->kichhoat = $request->kichhoat;


        $chapter->save();
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
        $chapter = Chapter::find($id);
        $truyen = Truyen::orderBy('id_truyen','DESC')->get();
        return view('admincp.chapter.edit')->with(compact('truyen','chapter'));
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
            'tieude'=>'required|max:255',
            'slug_chapter'=>'required|max:255',
            'noidung'=>'required',
            'tomtat'=>'required',
            'kichhoat'=>'required',
            'id_truyen'=>'required'
        ],[
            'slug_chapter.unique'=>'Slug đã có nhé, xin điền tên khác',
            'tieude.unique'=>'Tiêu đề đã có nhé, xin điền slug khác',
            'tieude.required'=>'Tiêu đề phải có nhé',
            'tomtat.required'=>'Tóm tắt truyện phải có nhé',
            'noidung.required'=>'Nội dung truyện phải có nhé',
            'slug_chapter.required'=>'Slug chapter phải có nhé',
        ]);
        $chapter = Chapter::find($id);
        $chapter->tieude = $request->tieude;
        $chapter->slug_chapter = $request->slug_chapter;
        $chapter->tomtat = $request->tomtat;
        $chapter->noidung = $request->noidung;
        $chapter->id_truyen = $request->id_truyen;
        $chapter->kichhoat = $request->kichhoat;


        $chapter->save();
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
        Chapter::find($id)->delete();
        return redirect()->back()->with('status','Xóa chapter thành công');
    }
}
