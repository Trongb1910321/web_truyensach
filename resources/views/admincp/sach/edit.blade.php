@extends('layouts.app')

@section('content')
    @include('layouts.nav')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Sửa sách đọc</div>
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
                        <form method="POST" action="{{ route('sach.update', [$sach->id]) }}" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Tên sách</label>
                                <input type="text" class="form-control" value="{{$sach->tensach}}" onkeyup="ChangeToSlug()" name="tensach" id="slug"
                                    aria-describedby="emailHelp" placeholder="Tên sách">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Lượt views</label>
                                <input type="text" class="form-control" value="{{$sach->views}}" onkeyup="ChangeToSlug()" name="views" id="slug"
                                    aria-describedby="emailHelp" placeholder="Tên sách">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Từ khóa</label>
                                <input type="text" class="form-control" value="{{$sach->tukhoa}}" onkeyup="ChangeToSlug()" name="tukhoa" id="tukhoa"
                                    aria-describedby="emailHelp" placeholder="Tên truyện">
                            </div>
                            {{-- <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Tác giả</label>
                                <input type="text" class="form-control" value="{{ old('tacgia') }}"  name="tacgia"
                                    aria-describedby="emailHelp" placeholder="Tác giả">
                            </div> --}}
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Slug sách</label>
                                <input type="text" class="form-control" value="{{$sach->slug_sach}}" name="slug_sach" id="convert_slug"
                                    aria-describedby="emailHelp" placeholder="Slug sách ....">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Tóm tắt sách</label>
                                <textarea name="tomtat" class="form-control" rows="5" style="resize: none">{{$sach->tomtat}}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Nội dung sách</label>
                                <textarea name="noidung" id="ckeditor_sach" class="form-control" rows="5" style="resize: none">{{$sach->noidung}}</textarea>
                            </div>

                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Hình ảnh sách</label>
                                <input type="file" class="form-control-file" name="hinhanh" >
                                <img src="{{asset('public/uploads/sach/'.$sach->hinhanh)}}" height="200" width="200" alt="">
                            </div>
                            {{-- <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Tình trạng</label>
                                <select class="form-select" name="tinhtrang" aria-label="Default select example">
                                    <option value="0">Tình trạng 0</option>
                                    <option value="1">Tình trạng 1</option>
                                </select>
                            </div> --}}

                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Kích hoạt</label>
                                <select class="form-select" name="kichhoat" aria-label="Default select example">
                                    @if ($sach->kichhoat==0)
                                    <option selected value="0">Kich hoạt</option>
                                    <option value="1">Không kích hoạt</option>
                                    @else
                                    <option value="0">Kich hoạt</option>
                                    <option selected value="1">Không kích hoạt</option>
                                    @endif
                                </select>
                            </div>


                            <button type="submit" name="themsach" class="btn btn-primary">Cập nhật</button>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
