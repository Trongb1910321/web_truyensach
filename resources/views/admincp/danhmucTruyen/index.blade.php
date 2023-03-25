@extends('layouts.app')

@section('content')
@include('layouts.nav')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Liệt kê danh mục truyện</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tên danh mục</th>
                            <th scope="col">Slug danh mục</th>
                            <th scope="col">Mô tả</th>
                            <th scope="col">Kích hoạt</th>
                            <th scope="col">Quản lý</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($danhmuctruyen as $key => $danhmuc)
                            <tr>
                              <th scope="row">{{ $key }}</th>
                              <td>{{ $danhmuc->tendanhmuc }}</td>
                              <td>{{ $danhmuc->slug_danhmuc }}</td>
                              <td>{{ $danhmuc->mota }}</td>
                              <td>
                                @if ($danhmuc->kichhoat==0)
                                    <span class="text text-success">Kích hoạt</span>
                                @else
                                <span class="text text-danger">Không Kích hoạt</span>
                                @endif
                              </td>
                              <td>
                                <a href="{{ route('danhmuc.edit',[$danhmuc->id_danhmuc]) }}" class="btn btn-primary mb-2">Edit</a>
                                <form action="{{ route('danhmuc.destroy',['danhmuc' => $danhmuc->id_danhmuc]) }}" method="POST">
                                  @method('DELETE')
                                  @csrf
                                  <button class="btn btn-danger">Delete</button>
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
