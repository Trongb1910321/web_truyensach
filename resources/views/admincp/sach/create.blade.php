@extends('layouts.app')

@section('content')
    @include('layouts.nav')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Thêm sách đọc</div>
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
                        <form method="POST" action="{{ route('sach.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Tên sách</label>
                                <input type="text" class="form-control" value="{{ old('tensach') }}" onkeyup="ChangeToSlug()" name="tensach" id="slug"
                                    aria-describedby="emailHelp" placeholder="Tên sách">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Lượt views</label>
                                <input type="text" class="form-control" value="{{ old('views') }}" onkeyup="ChangeToSlug()" name="views" id="slug"
                                    aria-describedby="emailHelp" placeholder="Tên sách">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Từ khóa</label>
                                <input type="text" class="form-control" value="{{ old('tukhoa') }}" onkeyup="ChangeToSlug()" name="tukhoa" id="tukhoa"
                                    aria-describedby="emailHelp" placeholder="Tên truyện">
                            </div>
                            {{-- <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Tác giả</label>
                                <input type="text" class="form-control" value="{{ old('tacgia') }}"  name="tacgia"
                                    aria-describedby="emailHelp" placeholder="Tác giả">
                            </div> --}}
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Slug sách</label>
                                <input type="text" class="form-control" value="{{ old('slug_sach') }}" name="slug_sach" id="convert_slug"
                                    aria-describedby="emailHelp" placeholder="Slug sách ....">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Tóm tắt sách</label>
                                <textarea name="tomtat" class="form-control" rows="5" style="resize: none"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Nội dung sách</label>
                                <textarea name="noidung" id="ckeditor_sach" class="form-control" rows="5" style="resize: none"></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Hình ảnh sách</label>
                                <input type="file" class="form-control-file" name="hinhanh" >
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Tình trạng</label>
                                <select class="form-select" name="tinhtrang" aria-label="Default select example">
                                    <option value="0">Tình trạng 0</option>
                                    <option value="1">Tình trạng 1</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Kích hoạt</label>
                                <select class="form-select" name="kichhoat" aria-label="Default select example">
                                    <option value="0">Kich hoạt</option>
                                    <option value="1">Không kích hoạt</option>
                                </select>
                            </div>


                            <button type="submit" name="themsach" class="btn btn-primary">Thêm sách</button>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
