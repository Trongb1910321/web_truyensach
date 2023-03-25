@extends('../layout')
@section('content')
<nav aria-label="breadcrumb" class="p-3 mb-2 bg-info text-dark">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a style="text-decoration: none;" href="{{ url('/') }}">Trang chủ</a></li>
        <li class="breadcrumb-item"><a style="text-decoration: none;"
            href="{{ url('the-loai/' . $truyen_breadcrumb->theloai->slug_theloai) }}">{{ $truyen_breadcrumb->theloai->tentheloai }}</a>
    </li>
        <li class="breadcrumb-item"><a
                href="{{ url('danh-muc/' . $truyen_breadcrumb->danhmuctruyen->slug_danhmuc) }}">{{ $truyen_breadcrumb->danhmuctruyen->tendanhmuc }}</a>
        </li>

        <li class="breadcrumb-item active" aria-current="page">{{ $truyen_breadcrumb->tentruyen }}</li>
    </ol>
</nav>
    <div class="row">
        <div class="col-md-12">
            <h4>{{ $chapter->truyen->tentruyen }}</h4>
            <p>Chương hiện tại :{{ $chapter->tieude }}</p>
            <div class="col-md-5">
                <style type="text/css">
                    .isDisabled{
                        color: currentColor;
                        pointer-events: none;
                        opacity: 0.5;
                        text-decoration: none;
                    }
                </style>
                <div class="form-group">
                    <label for="exampleInputEmail">Chọn chương</label>
                    <p><a class="btn btn-primary {{ $chapter->id==$min_id->id ? 'isDisabled' : ''}}" href="{{ url('xem-chapter/'.$previous_chapter) }}">Tập trước</a></p>
                    <select name="select-chapter" class="custom-select select-chapter">
                        @foreach ($all_chapter as $key => $chap)
                            <option value="{{url('xem-chapter/'.$chap->slug_chapter) }}">{{ $chap->tieude }}</option>
                        @endforeach
                    </select>
                    <p class="mt-3"><a class="btn btn-primary {{ $chapter->id==$max_id->id ? 'isDisabled' : ''}}" href="{{ url('xem-chapter/'.$next_chapter) }}">Tập sau</a></p>
                </div>

            </div>
            <div class="noidungchuong">
                {!! $chapter->noidung !!}

            </div>
            <div class="col-md-5">
                <div class="form-group">
                    <label for="exampleInputEmail">Chọn chương</label>
                    <select name="select-chapter" class="custom-select select-chapter">
                        @foreach ($all_chapter as $key => $chap)
                            <option value="{{url('xem-chapter/'.$chap->slug_chapter)}}">{{ $chap->tieude }}</option>
                        @endforeach
                    </select>
                </div>

            </div>
            <h3>Lưu và chia sẻ truyện : </h3>
            <a href=""><i class="fab fa-facebook-f"></i></a>
            <a href=""><i class="fab fa-twitter"></i></a>

        </div>
    </div>
@endsection
