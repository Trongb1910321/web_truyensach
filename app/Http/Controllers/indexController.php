<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\DanhmucTruyen;
use App\Models\Truyen;
use App\Models\Chapter;
use App\Models\Theloai;
use App\Models\Sach;
use Storage;
use App\Models\Info;

class indexController extends Controller
{
    public function kytu(Request $request, $kytu)
    {

        // { $data = $request->all();
        // $list_truyen = Truyen::with('danhmuctruyen','theloai')->where('tentruyen', 'LIKE', '%' . $kytu . '%')->orderBy('id_danhmuc','DESC')->get();
        $slide_truyen = Truyen::orderBy('id_truyen', 'DESC')->where('kichhoat', 0)->take(8)->get();
        $theloai = Theloai::orderBy('id', 'DESC')->get();
        $truyen = Truyen::orderBy('id_truyen', 'DESC')->where('kichhoat', 0)->take(8)->get();
        $danhmuc = DanhmucTruyen::orderBy('id_danhmuc', 'DESC')->get();
        if ($kytu == '0-9') {
            $rand = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
            $list_truyen = Truyen::with('danhmuctruyen', 'theloai')->where(
                function ($query) use ($rand) {
                    for ($i = 0; $i <= 9; $i++) {
                        $query->orwhere('tentruyen', 'LIKE', '%' . $rand[$i] . '%');
                    }
                }
            )->get();
        } else {
            $list_truyen = Truyen::with('danhmuctruyen', 'theloai')->where('tentruyen', 'LIKE', '%' . $kytu . '%')->orderBy('id_danhmuc', 'DESC')->get();
        }




        // $truyen = Truyen::with('danhmuctruyen', 'theloai')->where('tentruyen', 'LIKE', '%' . $kytu . '%')->get();
        return view('pages.kytu')->with(compact('danhmuc', 'truyen', 'theloai', 'slide_truyen', 'list_truyen'));
    }

    public function timkiem_ajax(Request $request)
    {
        $data = $request->all();
        if ($data['keywords']) {
            $truyen = Truyen::where('tinhtrang', 0)->where('tentruyen', 'LIKE', '%' . $data['keywords'] . '%')->get();
            $sach = Sach::where('tensach', 'LIKE', '%' . $data['keywords'] . '%')->get();
            // dd($truyen);
            $output = '<div class="dropdown"><ul class="dropdown-menu li" style="display:block;">';

            foreach ($truyen as $key => $tr) {
                $output .= '<li class="li_search_ajax"><a style="text-decoration: none" href="#">' . $tr->tentruyen . '</a></li>';
            }
            foreach ($sach as $key => $book) {
                $output .= '<li class="li_search_ajax"><a style="text-decoration: none" href="#">' . $book->tensach . '</a></li>';
            }

            $output .= '</ul></div>';
            // $output1 = '<div class="dropdown"><ul class="dropdown-menu li" style=" display:block; position: absolute;
            // // top: 180px;
            // // right: 0;
            // // width: 200px;
            // // height: 100px;
            // margin-top: 20%;
            // border: 3px solid #73AD21;">';
            // foreach ($sach as $key => $book) {
            //     $output1 .= '<li class="li_search_ajax"><a style="text-decoration: none" href="#">' . $book->tensach . '</a></li>';
            // }
            // $output1 .= '</ul></div>';

            echo $output;
            // echo $output1;
        }
    }
    public function tabs_danhmuc(Request $request)
    {
        $data = $request->all();
        $output = '';
        $truyen = Truyen::with('danhmuctruyen', 'theloai')->where('id_danhmuc', $data['danhmuc_id'])->take(10)->get();
        foreach ($truyen as $key => $value) {
            $output .= '
                <ul class="mucluctab_truyen" style="
                -moz-column-count: 3;
                -moz-column-gap: 20px;
                -webkit-column-count: 3;
                -webkit-column-gap: 20px;
                column-count: 3;
                column-gap: 20px;">
                    <li><a target="_blank" href="' . url('xem-truyen/' . $value->slug_truyen) . '">' . $value->tentruyen . '</a></li>
                </ul>
            ';
        }
        echo $output;
    }
    public function home()
    {
        $theloai = Theloai::orderBy('id', 'DESC')->get();
        $slide_truyen = Truyen::orderBy('id_truyen', 'DESC')->where('kichhoat', 0)->take(8)->get();
        $danhmuc = DanhmucTruyen::orderBy('id_danhmuc', 'DESC')->get();
        $truyen = Truyen::orderBy('id_truyen', 'DESC')->where('kichhoat', 0)->where('truyen_noibat', 0)->get();
        $truyen_xemnhieu = Truyen::orderBy('id_truyen', 'DESC')->where('kichhoat', 0)->where('truyen_noibat', 2)->get();
        $truyen_noibat = Truyen::orderBy('id_truyen', 'DESC')->where('kichhoat', 0)->where('truyen_noibat', 1)->get();
        return view('pages.home')->with(compact('danhmuc', 'truyen', 'theloai', 'slide_truyen', 'truyen_xemnhieu', 'truyen_noibat'));
    }
    public function xemsachnhanh(Request $request)
    {
        $sach_id = $request->sach_id;
        $sach = Sach::find($sach_id);

        $output['tieude_sach'] = $sach->tensach;
        $output['noidung_sach'] = $sach->noidung;
        echo json_encode($output);
    }

    public function docsach()
    {
        $theloai = Theloai::orderBy('id', 'DESC')->get();
        $slide_truyen = Truyen::orderBy('id_truyen', 'DESC')->where('kichhoat', 0)->take(8)->get();
        $danhmuc = DanhmucTruyen::orderBy('id_danhmuc', 'DESC')->get();
        $sach = Sach::orderBy('id', 'DESC')->where('kichhoat', 0)->get();
        return view('pages.sach')->with(compact('danhmuc', 'sach', 'theloai', 'slide_truyen'));
    }
    public function danhmuc($slug)
    {
        $theloai = Theloai::orderBy('id', 'DESC')->get();
        $danhmuc = DanhmucTruyen::orderBy('id_danhmuc', 'DESC')->get();
        $slide_truyen = Truyen::orderBy('id_truyen', 'DESC')->where('kichhoat', 0)->take(8)->get();
        $danhmuc_id = DanhmucTruyen::where('slug_danhmuc', $slug)->first();
        // echo $danhmuc_id->id_danhmuc;
        $tendanhmuc = $danhmuc_id->tendanhmuc;
        $truyen = Truyen::orderBy('id_truyen', 'DESC')->where('kichhoat', 0)->where('id_danhmuc', $danhmuc_id->id_danhmuc)->get();
        return view('pages.danhmuc')->with(compact('danhmuc', 'truyen', 'tendanhmuc', 'theloai', 'slide_truyen'));
    }
    public function theloai($slug)
    {
        $theloai = Theloai::orderBy('id', 'DESC')->get();
        $danhmuc = DanhmucTruyen::orderBy('id_danhmuc', 'DESC')->get();
        $slide_truyen = Truyen::orderBy('id_truyen', 'DESC')->where('kichhoat', 0)->take(8)->get();
        $theloai_id = Theloai::where('slug_theloai', $slug)->first();
        $tentheloai = $theloai_id->tentheloai;
        $truyen = Truyen::orderBy('id_truyen', 'DESC')->where('kichhoat', '0')->where('theloai_id', $theloai_id->id)->get();
        return view('pages.theloai', compact('danhmuc', 'truyen', 'tentheloai', 'theloai', 'slide_truyen'));
    }
    public function xemtruyen($slug)
    {
        $theloai = Theloai::orderBy('id', 'DESC')->get();
        $danhmuc = DanhmucTruyen::orderBy('id_danhmuc', 'DESC')->get();
        $slide_truyen = Truyen::orderBy('id_truyen', 'DESC')->where('kichhoat', 0)->take(8)->get();
        $truyen = Truyen::with('danhmuctruyen', 'theloai')->where('slug_truyen', $slug)->first();
        $chapter = Chapter::with('truyen')->orderBy('id', 'ASC')->where('id_truyen', $truyen->id_truyen)->get();
        $chapter_dau = Chapter::with('truyen')->orderBy('id', 'ASC')->where('id_truyen', $truyen->id_truyen)->first();
        $chapter_moinhat = Chapter::with('truyen')->orderBy('id', 'DESC')->where('id_truyen', $truyen->id_truyen)->first();
        $cungdanhmuc = Truyen::with('danhmuctruyen', 'theloai')->where('id_danhmuc', $truyen->danhmuctruyen->id_danhmuc)->whereNotIn('id_truyen', [$truyen->id_truyen])->get();
        $truyennoibat = Truyen::where('truyen_noibat', 1)->take(20)->get();
        $truyenxemnhieu = Truyen::where('truyen_noibat', 2)->take(20)->get();
        return view('pages.truyen', compact('danhmuc', 'truyen', 'chapter', 'cungdanhmuc', 'chapter_dau', 'theloai', 'slide_truyen', 'chapter_moinhat', 'truyennoibat', 'truyenxemnhieu'));
    }
    public function xemsach($slug)
    {
        $theloai = Theloai::orderBy('id', 'DESC')->get();
        $danhmuc = DanhmucTruyen::orderBy('id_danhmuc', 'DESC')->get();
        $slide_truyen = Truyen::orderBy('id_truyen', 'DESC')->where('kichhoat', 0)->take(8)->get();
        $truyen = Truyen::with('danhmuctruyen', 'theloai')->where('slug_truyen', $slug)->first();
        // $chapter = Chapter::with('truyen')->orderBy('id', 'ASC')->where('id_truyen', $truyen->id_truyen)->get();
        // $chapter_dau = Chapter::with('truyen')->orderBy('id', 'ASC')->where('id_truyen', $truyen->id_truyen)->first();
        // $chapter_moinhat = Chapter::with('truyen')->orderBy('id', 'DESC')->where('id_truyen', $truyen->id_truyen)->first();
        // $cungdanhmuc = Truyen::with('danhmuctruyen', 'theloai')->where('id_danhmuc', $truyen->danhmuctruyen->id_danhmuc)->whereNotIn('id_truyen', [$truyen->id_truyen])->get();
        $truyennoibat = Truyen::where('truyen_noibat', 1)->take(20)->get();
        $truyenxemnhieu = Truyen::where('truyen_noibat', 2)->take(20)->get();
        $sach = Sach::where('slug_sach', $slug)->get();

        return view('pages.sach', compact('sach', 'danhmuc', 'truyen', 'theloai', 'slide_truyen', 'truyennoibat', 'truyenxemnhieu'));
    }




    public function xemchapter($slug)
    {
        $theloai = Theloai::orderBy('id', 'DESC')->get();
        $danhmuc = DanhmucTruyen::orderBy('id_danhmuc', 'DESC')->get();
        $slide_truyen = Truyen::orderBy('id_truyen', 'DESC')->where('kichhoat', 0)->take(8)->get();

        $truyen = Chapter::where('slug_chapter', $slug)->first();
        // breadcrumb
        $truyen_breadcrumb = Truyen::with('danhmuctruyen', 'theloai')->where('id_truyen', $truyen->id_truyen)->first();
        // end breadcrumb

        $chapter = Chapter::with('truyen')->where('slug_chapter', $slug)->where('id_truyen', $truyen->id_truyen)->first();

        $all_chapter = Chapter::with('truyen')->orderBy('id', 'ASC')->where('id_truyen', $truyen->id_truyen)->get();

        $next_chapter = Chapter::where('id_truyen', $truyen->id_truyen)->where('id', '>', $chapter->id)->min('slug_chapter');

        $max_id = Chapter::where('id_truyen', $truyen->id_truyen)->orderBy('id', 'DESC')->first();

        $min_id = Chapter::where('id_truyen', $truyen->id_truyen)->orderBy('id', 'ASC')->first();

        $previous_chapter = Chapter::where('id_truyen', $truyen->id_truyen)->where('id', '<', $chapter->id)->max('slug_chapter');

        return view('pages.chapter', compact('danhmuc', 'truyen', 'chapter', 'theloai', 'slide_truyen', 'truyen_breadcrumb', 'max_id', 'min_id', 'all_chapter', 'next_chapter', 'previous_chapter'));
    }
    public function timkiem(Request $request)
    {
        $data = $request->all();
        $slide_truyen = Truyen::orderBy('id_truyen', 'DESC')->where('kichhoat', 0)->take(8)->get();
        $theloai = Theloai::orderBy('id', 'DESC')->get();
        $danhmuc = DanhmucTruyen::orderBy('id_danhmuc', 'DESC')->get();
        $tukhoa = $data['tukhoa'];
        $truyen = Truyen::with('danhmuctruyen', 'theloai')->where('tentruyen', 'LIKE', '%' . $tukhoa . '%')->orWhere('tomtat', 'LIKE', '%' . $tukhoa . '%')->orWhere('tacgia', 'LIKE', '%' . $tukhoa . '%')->get();
        $sach = Sach::where('tensach', 'LIKE', '%' . $tukhoa . '%')->orWhere('tukhoa', 'LIKE', '%' . $tukhoa . '%')->get();
        return view('pages.timkiem')->with(compact('danhmuc', 'truyen', 'theloai', 'slide_truyen', 'tukhoa', 'sach'));
    }
    public function tag($tag)
    {
        $slide_truyen = Truyen::with('thuocnhieudanhmuctruyen', 'thuocnhieutheloaitruyen')->orderBy('id_truyen', 'DESC')->where('kichhoat', 0)->take(8)->get();
        $theloai = Theloai::orderBy('id', 'DESC')->get();
        $danhmuc = DanhmucTruyen::orderBy('id_danhmuc', 'DESC')->get();
        $tags = explode("-", $tag);
        $truyen = Truyen::with('danhmuctruyen', 'theloai')->where(
            function ($query) use ($tags) {
                for ($i = 0; $i < count($tags); $i++) {
                    $query->orWhere('tukhoa', 'LIKE', '%' . $tags[$i] . '%');
                }
            }
        )->paginate(12);

        return view('pages.tag')->with(compact('danhmuc', 'truyen', 'theloai', 'slide_truyen', 'tag'));
    }




    // public function xemtruyen($slug){
    //     $danhmuc = DanhmucTruyen::orderBy('id_danhmuc','DESC')->get();
    //     $chapter = Chapter::orderBy('id','DESC')->get();
    //     $truyen = Truyen::where('slug_truyen',$slug)->first();
    //     return view('pages.chapter',compact('danhmuc','truyen','chapter'));
    // }
    // public function xemtruyen($slug){
    //     $chapter_selected = $_POST['selected1'] ?? NULL;
    //     $danhmuc = DanhmucTruyen::orderBy('id_danhmuc','DESC')->get();
    //     $chapter = Chapter::orderBy('id','DESC')->get();
    //     $chapter1 = Chapter::where('id',$chapter_selected)->first();
    //     $truyen = Truyen::where('slug_truyen',$slug)->first();
    //     return view('pages.chapter',compact('danhmuc','truyen','chapter','chapter1'));
    // }

}
