@extends('layouts.app')

@section('content')
    @include('layouts.nav')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Thống kê truyện</div>

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
                                    {{-- <th scope="col">#</th> --}}
                                    <th scope="col">Số lượng truyện</th>
                                    <th scope="col">Số lượng danh mục</th>
                                    <th scope="col">Số lượng thể loại</th>
                                    <th scope="col">Số lượng sách</th>

                                        @if(Auth::user()->role_as== '1' )
                                        <th scope="col"> Số lượng nhân viên</th>
                                        <th scope="col"> Số lượng khách hàng</th>
                                        @endif


                                    {{-- <th scope="col">Thống kê thể loại</th>
                                    <th scope="col">Thống kê tác giả</th> --}}
                                    {{-- <th scope="col">Danh mục</th>
                                    <th scope="col">Thể loại</th>
                                    <th scope="col">Tình Trạng</th>
                                    <th scope="col">Truyện nổi bật</th>
                                    <th scope="col">Từ khóa</th>
                                    <th scope="col">Ngày tạo</th>
                                    <th scope="col">Ngày cập nhật</th>
                                    <th scope="col">Kích hoạt</th> --}}
                                    <th scope="col">Quản lý</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @foreach ($count as $key => $thongke) --}}
                                    <tr>
                                        {{-- <th scope="row">{{ $key + 1 }}</th> --}}
                                        <td>{{ $count }} <br><a class="btn btn-primary" href="{{ route('truyen.index') }}">Xem tất cả</a></td>
                                        <td>{{ $count_danhmuc }}<br><a class="btn btn-primary" href="{{ route('danhmuc.index') }}">Xem tất cả</a></td>
                                        <td>{{ $count_theloai }}<br><a class="btn btn-primary" href="{{ route('theloai.index') }}">Xem tất cả</a></td>
                                        <td>{{ $count_sach }}<br><a class="btn btn-primary" href="{{ route('sach.index') }}">Xem tất cả</a></td>
                                        @if(Auth::user()->role_as== '1' )
                                        <td>{{ $count_nhanvien }}<br><a class="btn btn-primary" href="{{ route('thongke.create') }}">Xem tất cả</a></td>
                                        <td>{{ $count_khachhang }}<br><a class="btn btn-primary" href="{{ route('thongke.create') }}">Xem tất cả</a></td>
                                        @endif

                                        {{-- <td><img src="{{ asset('public/uploads/truyen/' . $truyen->hinhanh) }}"
                                                height="200" width="200" alt=""></td>
                                        <td>{{ $$thongke->slug_truyen }}</td>
                                        <td>{{ $truyen->tomtat }}</td>
                                        <td>{{ $truyen->danhmuctruyen->tendanhmuc }}</td>
                                        <td>{{ $truyen->theloai->tentheloai }}</td>
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
                                        </td>
                                        <td>{{ $truyen->tukhoa }}</td>
                                        <td>{{ $truyen->created_at }} <br>
                                            <p>{{ $truyen->created_at->diffForHumans() }}</p>
                                        </td>
                                        <td>
                                            @if ($truyen->updated_at != null)
                                                {{ $truyen->updated_at }} <br>
                                                <p>{{ $truyen->updated_at->diffForHumans() }}</p>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($truyen->kichhoat == 0)
                                                <span class="text text-success">Kích hoạt</span>
                                            @else
                                                <span class="text text-danger">Không Kích hoạt</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('truyen.edit', [$truyen->id_truyen]) }}"
                                                class="btn btn-primary mb-2">Edit</a>
                                            <form action="{{ route('truyen.destroy', ['truyen' => $truyen->id_truyen]) }}"
                                                method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button onclick="return confirm('Bạn muốn xóa truyện này không?')"
                                                    class="btn btn-danger">Delete</button>
                                            </form>
                                        </td> --}}
                                    </tr>
                                {{-- @endforeach --}}
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
