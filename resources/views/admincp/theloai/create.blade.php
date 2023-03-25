@extends('layouts.app')

@section('content')
    @include('layouts.nav')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Thêm thể loại truyện</div>
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
                        <form method="POST" action="{{ route('theloai.store') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Tên thể loại</label>
                                <input type="text" class="form-control" value="{{ old('tentheloai') }}" onkeyup="ChangeToSlug()" name="tentheloai" id="slug"
                                    aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Slug thể loại</label>
                                <input type="text" class="form-control" value="{{ old('slug') }}" name="slug_theloai" id="convert_slug"
                                    aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Mô tả thể loại</label>
                                <input type="text" class="form-control" value="{{ old('mota') }}" name="mota" id="exampleInputEmail1"
                                    aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Kích hoạt</label>
                                <select class="form-select" name="kichhoat" aria-label="Default select example">
                                    <option value="0">Kich hoạt</option>
                                    <option value="1">Không kích hoạt</option>
                                </select>
                            </div>


                            <button type="submit" class="btn btn-primary">Thêm</button>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
