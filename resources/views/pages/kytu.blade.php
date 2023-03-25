@extends('../layout')
@section('slide')
    @include('pages.slide')
@endsection
@section('content')
    <h3>Lọc truyện theo kí tự từ A-Z</h3>
    <div id="tab_danhmuctruyen"></div>
    <style type="text/css">
        a.kytu{
            font-weight: bold;
            padding: 5px 13px;
            color: black;
            font-size: 15px;
            background: burlywood;
            cursor: pointer;
        }
    </style>
    <a class="kytu" href="{{ url('/kytu/0-9') }}">0-9</a>
    @foreach (range('A', 'Z') as $char)
        <a class="kytu" style="text-decoration: none;" href="{{ url('/kytu/' . $char) }}">{{ $char }}</a>
    @endforeach


    <h3 style="text-align: center; color:blueviolet; padding:10px;">Sách mới cập nhật</h3>
    <div class="album py-5 bg-light">
        <div class="container">
            <table class="table card-body">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tên truyện</th>
                        <th scope="col">Hình ảnh truyện</th>
                        <th scope="col">Danh mục truyện</th>
                        <th scope="col">Thể loại truyện</th>
                        {{-- <th scope="col">Lượt xemn</th> --}}
                        <th scope="col">Xem</th>
                    </tr>
                </thead>
                <tbody>
                    <div class="">
                        @foreach ($list_truyen as $key => $tr)
                            <tr>
                                <th scope="row">{{ $key }}</th>
                                <td>{{ $tr->tentruyen }}</td>
                                <td><img class="" src="{{ asset('public/uploads/truyen/' . $tr->hinhanh) }}"
                                        width="100" height="100"></td>
                                <td>
                                    {{ $tr->danhmuctruyen->tendanhmuc }}
                                </td>
                                <td>{{ $tr->theloai->tentheloai }}</td>
                                {{-- <td>{{ $tr->truyen->views }}</td> --}}
                                <td><a  href="{{ url('xem-truyen/' . $tr->slug_truyen) }}">Xem truyện</a></td>
                            </tr>
                        @endforeach
                    </div>


                </tbody>
            </table>

            {{-- <a class="btn btn-success" href=""> Xem tất cả</a> --}}
        </div>

    </div>
@endsection
