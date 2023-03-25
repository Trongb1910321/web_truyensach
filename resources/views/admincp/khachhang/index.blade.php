@extends('layouts.app')

@section('content')
    @include('layouts.nav')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Liệt kê khách hàng</div>

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
                                    <th scope="col">Họ và Tên</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">UserName</th>
                                    <th scope="col">Ngày cấp tài khoản</th>



                                    {{-- <th scope="col">Từ khóa</th> --}}
                                    {{-- <th scope="col">Ngày tạo</th>
                                    <th scope="col">Ngày cập nhật</th>
                                    <th scope="col">Kích hoạt</th>
                                    <th scope="col">Quản lý</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list_khachhang as $key => $sach)
                                    <tr>
                                        <th scope="row">{{ $key + 1 }}</th>
                                        <td>{{ $sach->name }}</td>
                                        {{-- <td><img src="{{ asset('public/uploads/sach/' . $sach->hinhanh) }}"
                                                height="200" width="200" alt=""></td> --}}
                                        <td>{{ $sach->email }}</td>
                                        <td>{{ $sach->name }}</td>
                                        <td>{{ $sach->created_at }}</td>
                                        {{-- <td>{{ $sach->created_at }} <br>
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
                                        </td> --}}
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
