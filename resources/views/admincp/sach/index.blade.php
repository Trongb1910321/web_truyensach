@extends('layouts.app')

@section('content')
    @include('layouts.nav')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Liệt kê sách</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <table class="table">
                            <div id="thongbao"></div>
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Tên danh mục</th>
                                    <th scope="col">Hình ảnh</th>
                                    <th scope="col">Slug truyện</th>
                                    <th scope="col">Tóm tắt</th>



                                    <th scope="col">Từ khóa</th>
                                    <th scope="col">Ngày tạo</th>
                                    <th scope="col">Ngày cập nhật</th>
                                    <th scope="col">Kích hoạt</th>
                                    <th scope="col">Quản lý</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list_sach as $key => $sach)
                                    <tr>
                                        <th scope="row">{{ $key + 1 }}</th>
                                        <td>{{ $sach->tensach }}</td>
                                        <td><img src="{{ asset('public/uploads/sach/' . $sach->hinhanh) }}"
                                                height="200" width="200" alt=""></td>
                                        <td>{{ $sach->slug_sach }}</td>
                                        <td>{{ $sach->tomtat }}</td>
                                        {{-- <td>{{ $sach->danhmuctruyen->tendanhmuc }}</td> --}}
                                        {{-- <td>{{ $truyen->theloai->tentheloai }}</td>
                                        <td>{{ $truyen->tinhtrang }}</td> --}}
                                        {{-- <td width="10%">
                                            @if ($truyen->truyen_noibat == 0)
                                            <form>
                                                @csrf
                                                <select class="form-select custom-select truyennoibat" data-truyen_id="{{ $truyen->id_truyen }}" name="truyennoibat"
                                                    aria-label="Default select example">
                                                        <option selected value="0">Truyện mới 0</option>
                                                        <option value="1">Truyện nổi bật/hot </option>
                                                        <option value="2">Truyện xem nhiều </option>

                                                </select>
                                            </form>
                                            @elseif($truyen->truyen_noibat == 1)
                                            <form>
                                                @csrf
                                                <select class="form-select custom-select truyennoibat" data-truyen_id="{{ $truyen->id_truyen }}" name="truyennoibat"
                                                    aria-label="Default select example">
                                                        <option value="0">Truyện mới 0</option>
                                                        <option selected value="1">Truyện nổi bật/hot </option>
                                                        <option value="2">Truyện xem nhiều </option>

                                                </select>
                                            </form>
                                            @else
                                            <form>
                                                @csrf
                                                <select class="form-select custom-select truyennoibat" data-truyen_id="{{ $truyen->id_truyen }}" name="truyennoibat"
                                                    aria-label="Default select example">
                                                        <option selected value="0">Truyện mới 0</option>
                                                        <option value="1">Truyện nổi bật/hot </option>
                                                        <option selected value="2">Truyện xem nhiều </option>

                                                </select>
                                            </form>
                                            @endif
                                        </td> --}}
                                        <td>{{ $sach->tukhoa }}</td>
                                        <td>{{ $sach->created_at }} <br>
                                            <p>{{ $sach->created_at->diffForHumans() }}</p>
                                        </td>
                                        <td>
                                            @if ($sach->updated_at != null)
                                                {{ $sach->updated_at }} <br>
                                                <p>{{ $sach->updated_at->diffForHumans() }}</p>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($sach->kichhoat == 0)
                                                <span class="text text-success">Kích hoạt</span>
                                            @else
                                                <span class="text text-danger">Không Kích hoạt</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('sach.edit', [$sach->id]) }}"
                                                class="btn btn-primary mb-2">Edit</a>
                                            <form action="{{ route('sach.destroy', ['sach' => $sach->id]) }}"
                                                method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button onclick="return confirm('Bạn muốn xóa sách này không?')"
                                                    class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
