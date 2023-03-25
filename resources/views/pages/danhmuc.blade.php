@extends('../layout')
{{-- @section('slide')
    @include('pages.slide')
@endsection --}}
@section('content')
    <nav aria-label="breadcrumb" class="p-3 mb-2 bg-info text-dark">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a style="text-decoration: none;" href="{{ url('/') }}">Trang chủ</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $tendanhmuc }}</li>
        </ol>
    </nav>
    <h3 style="text-align: center; color:blueviolet">Sách theo danh mục: {{ $tendanhmuc }}</h3>
    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row">
                @php
                    $count = count($truyen);
                @endphp
                @if ($count == 0)
                    <div class="col-md-12">
                        <div class="card mb-12 box-shadow">
                            <div class="card-body p-3">
                                <p>Truyện đang cập nhật......</p>
                            </div>
                        </div>

                    </div>
                @else
                    @foreach ($truyen as $key => $value)
                        <div class="col-md-3">
                            <div class="card mb-3 box-shadow">
                                    <img class="card-img-top"  src="{{ asset('public/uploads/truyen/' . $value->hinhanh) }}"
                                        alt="Card image cap">
                                    <div class="card-body">
                                        <h5>
                                            @php
                                                $tentruyen = substr($value->tentruyen, 0, 25);
                                            @endphp
                                            {{ $tentruyen . '.....' }}
                                        </h5>
                                        <p class="card-text">
                                            @php
                                                $tomtat = substr($value->tomtat, 0, 120);
                                            @endphp
                                            {{ $tomtat . '.....' }}
                                        </p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="btn-group">
                                                <a href="{{ route('xemtruyen', $value->slug_truyen) }}"
                                                    class="btn btn-sm btn-outline-secondary">Đọc ngay</a>
                                                {{-- url('xem-truyen/'.$value->slug_truyen) --}}
                                                <a class="btn btn-sm btn-outline-secondary"><i
                                                        class="fa-sharp fa-solid fa-eye"></i>
                                                    123000 </p></a>
                                            </div>
                                            <small class="text-muted">9 mins agos</small>
                                        </div>
                                    </div>
                            </div>

                        </div>
                    @endforeach
                @endif
            </div>
            {{-- <a class="btn btn-success mt-3 p-2" href=""> Xem tất cả</a> --}}
        </div>

    </div>
@endsection
