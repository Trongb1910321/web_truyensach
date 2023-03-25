@extends('layouts.app')

@section('content')
    @include('layouts.nav')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Cập nhật truyện</div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ route('truyen.update',[$truyen->id_truyen]) }}" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Tên truyện</label>
                                <input type="text" class="form-control" value="{{ $truyen->tentruyen }}" onkeyup="ChangeToSlug()" name="tentruyen" id="slug"
                                    aria-describedby="emailHelp" placeholder="Tên truyện">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Từ khóa</label>
                                <input type="text" class="form-control" value="{{ $truyen->tukhoa }}" onkeyup="ChangeToSlug()" name="tukhoa" id="tukhoa"
                                    aria-describedby="emailHelp" placeholder="Từ khóa">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Tác giả</label>
                                <input type="text" class="form-control" value="{{ $truyen->tacgia }}"  name="tacgia"
                                    aria-describedby="emailHelp" placeholder="Tác giả">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Slug truyện</label>
                                <input type="text" class="form-control" value="{{ $truyen->slug_truyen }}" name="slug_truyen" id="convert_slug"
                                    aria-describedby="emailHelp" placeholder="Slug truyện ....">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Tóm tắt truyện</label>
                                <textarea name="tomtat" class="form-control" rows="5"  style="resize: none">{{ $truyen->tomtat }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Danh mục truyện</label>
                                <select class="form-select" name="danhmuc" aria-label="Default select example">
                                    {{-- @foreach ($danhmuc as $key => $value)
                                        <option value="{{ $key }}"
                                        @if ($key == old('danhmuc', $truyen->id_danhmuc))
                                            selected="selected"
                                        @endif
                                        >{{ $value->tendanhmuc }}</option>
                                    @endforeach --}}
                                    @foreach ( $danhmuc as $key => $muc)
                                    <option {{$muc->id_danhmuc==$truyen->id_danhmuc ? 'selected' : '' }} value="{{$muc->id_danhmuc}}">{{ $muc->tendanhmuc }}</option>
                                    @endforeach
                                    {{-- @foreach ( $danhmuc as $key => $muc)
                                    <option {{$muc->id_danhmuc == $truyen->id_danhmuc ? 'selected' : '' }} value="{{ $muc->id_truyen }}">{{ $muc->tendanhmuc }}</option>
                                    @endforeach --}}
                                </select>

                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Thể loại truyện</label>
                                <select class="form-select" name="theloai" aria-label="Default select example">
                                    {{-- @foreach ($theloai as $key => $value)
                                        <option value="{{ $key }}"
                                        @if ($key == old('theloai', $truyen->theloai_id))
                                            selected="selected"
                                        @endif
                                        >{{ $value->tentheloai }}</option>
                                    @endforeach --}}
                                    @foreach ( $theloai as $key => $the)
                                    <option {{$the->id==$truyen->theloai_id ? 'selected' : '' }} value="{{$the->id}}">{{ $the->tentheloai }}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Hình ảnh truyện</label>
                                <input type="file" class="form-control-file" name="hinhanh" >
                                <img src="{{asset('public/uploads/truyen/'.$truyen->hinhanh)}}" height="200" width="200" alt="">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Tình trạng</label>
                                <select class="form-select" name="tinhtrang" aria-label="Default select example">
                                    @if ($truyen->kichhoat==0)
                                    <option selected value="0">Tình trạng 0</option>
                                    <option value="1">Tình trạng 1</option>
                                    @else
                                    <option value="0">Tình trạng 0</option>
                                    <option selected value="1">Tình trạng 1</option>
                                    @endif
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Truyện nổi bật</label>
                                <select class="form-select" name="truyennoibat" aria-label="Default select example">
                                    @if ($truyen->truyennoibat==0)
                                    <option selected value="0">Truyện mới 0</option>
                                    <option value="1">Truyện nổi bật/hot </option>
                                    <option value="2">Truyện xem nhiều </option>
                                    @elseif($truyen->truyennoibat==1)
                                    <option value="0">Truyện mới 0</option>
                                    <option selected value="1">Truyện nổi bật/hot</option>
                                    <option value="2">Truyện xem nhiều </option>
                                    @else
                                    <option value="0">Truyện mới 0</option>
                                    <option value="1">Truyện nổi bật/hot</option>
                                    <option selected value="2">Truyện xem nhiều</option>
                                    @endif
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Kích hoạt</label>
                                <select class="form-select" name="kichhoat" aria-label="Default select example">
                                    @if ($truyen->kichhoat==0)
                                    <option selected value="0">Kich hoạt</option>
                                    <option value="1">Không kích hoạt</option>
                                    @else
                                    <option value="0">Kich hoạt</option>
                                    <option selected value="1">Không kích hoạt</option>
                                    @endif
                                </select>
                            </div>


                            <button type="submit" name="themtruyen" class="btn btn-primary">Cập nhật</button>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
