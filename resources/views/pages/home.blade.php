@extends('../layout')
@section('slide')
    @include('pages.slide')
@endsection
@section('content')
    <!-- Nav tabs -->
    @if (Session::has('success'))
    <div class="alert alert-success">{{ Session::get('success') }}</div>

    @endif
    @if (Session::has('fail'))
    <div class="alert alert-danger">{{ Session::get('fail') }}</div>

    @endif
    <ul class="nav nav-tabs">
        @php
            $i = 0;
        @endphp
        @foreach ($danhmuc as $key => $tab_danhmuc)
            @php
                $i++;
            @endphp
            <form>
                @csrf
                <li class="nav-item {{ $i == 1 ? 'active' : '' }}">
                    <a data-danhmuc_id="{{ $tab_danhmuc->id_danhmuc }}" class="nav-link tabs_danhmuc" data-bs-toggle="tab"
                        href="#{{ $tab_danhmuc->slug_danhmuc }}">{{ $tab_danhmuc->tendanhmuc }}</a>
                </li>
            </form>
        @endforeach



    </ul>


    <div id="tab_danhmuctruyen"></div>
    {{-- <div>{{ $data->email }}</div> --}}
    <h3 class="mt-5">Lọc truyện theo kí tự từ A-Z</h3>
    <style type="text/css">
        a.kytu {
            font-weight: bold;
            padding: 5px 10px;
            color: black;
            font-size: 15px;
            background: burlywood;
            cursor: pointer;
           
        }
    </style>
    @foreach (range('A', 'Z') as $char)
       <a style="text-decoration: none;" class="kytu" href="{{ url('/kytu/' . $char) }}">{{ $char }}</a>
    @endforeach


    <h3 style="text-align: center; color:blueviolet; padding:10px;">Truyện mới cập nhật</h3>
    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row">
                @foreach ($truyen as $key => $value)
                    <div class="col-md-3">
                        <div class="card mb-3 box-shadow">
                            <img class="card-img-top" src="{{ asset('public/uploads/truyen/' . $value->hinhanh) }}"
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
                                        $tomtat = substr($value->tomtat, 0, 25);
                                    @endphp
                                    {{ $tomtat . '.....' }}
                                </p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <a href="{{ route('xemtruyen', $value->slug_truyen) }}"
                                            class="btn btn-sm btn-outline-secondary">Đọc ngay</a>
                                        {{-- url('xem-truyen/'.$value->slug_truyen) --}}
                                        <a class="btn btn-sm btn-outline-secondary"><i class="fa-sharp fa-solid fa-eye"></i>
                                            123000 </p></a>
                                    </div>
                                    <small class="text-muted p-2">
                                        <p>{{ $value->created_at->diffForHumans() }}</p>
                                    </small>
                                </div>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>
            <a class="btn btn-success" href=""> Xem tất cả</a>
        </div>

    </div>

    <!----------------Sach hay xem nhieu-------------------->
    <h3 style="text-align: center; color:blueviolet">Truyện hay xem nhiều</h3>
    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row">
                @foreach ($truyen_xemnhieu as $key => $value_1)
                    <div class="col-md-3">
                        <div class="card mb-3 box-shadow">
                            <img class="card-img-top" src="{{ asset('public/uploads/truyen/' . $value_1->hinhanh) }}"
                                alt="Card image cap">
                            <div class="card-body">
                                <h5>
                                    @php
                                        $tentruyen = substr($value_1->tentruyen, 0, 25);
                                    @endphp
                                    {{ $tentruyen . '.....' }}
                                </h5>
                                <p class="card-text">
                                    @php
                                        $tomtat = substr($value_1->tomtat, 0, 30);
                                    @endphp
                                    {{ $tomtat . '.....' }}
                                </p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <a href="{{ route('xemtruyen', $value_1->slug_truyen) }}"
                                            class="btn btn-sm btn-outline-secondary">Đọc ngay</a>
                                        {{-- url('xem-truyen/'.$value->slug_truyen) --}}
                                        <a class="btn btn-sm btn-outline-secondary"><i class="fa-sharp fa-solid fa-eye"></i>
                                            123000 </p></a>
                                    </div>
                                    <small class="text-muted p-2">
                                        <p>{{ $value_1->created_at->diffForHumans() }}</p>
                                    </small>
                                </div>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>
            <a class="btn btn-success" href=""> Xem tất cả</a>
        </div>
    </div>
    <!----------------Blog-------------------->
    <h3 style="text-align: center; color:blueviolet">Blog</h3>
    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row">
                @foreach ($truyen_noibat as $key => $value_2)
                    <div class="col-md-3">
                        <div class="card mb-3 box-shadow">
                            <img class="card-img-top" src="{{ asset('public/uploads/truyen/' . $value_2->hinhanh) }}"
                                alt="Card image cap">
                            <div class="card-body">
                                <h5>
                                    @php
                                        $tentruyen = substr($value_2->tentruyen, 0, 25);
                                    @endphp
                                    {{ $tentruyen . '.....' }}
                                </h5>
                                <p class="card-text">
                                    @php
                                        $tomtat = substr($value_2->tomtat, 0, 30);
                                    @endphp
                                    {{ $tomtat . '.....' }}
                                </p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <a href="{{ route('xemtruyen', $value_2->slug_truyen) }}"
                                            class="btn btn-sm btn-outline-secondary">Đọc ngay</a>
                                        {{-- url('xem-truyen/'.$value->slug_truyen) --}}
                                        <a class="btn btn-sm btn-outline-secondary"><i class="fa-sharp fa-solid fa-eye"></i>
                                            123000 </p></a>
                                    </div>
                                    <small class="text-muted p-2">
                                        <p>{{ $value_2->created_at->diffForHumans() }}</p>
                                    </small>
                                </div>
                            </div>
                        </div>

                    </div>
                @endforeach

            </div>
            <a class="btn btn-success" href=""> Xem tất cả</a>
        </div>

    </div>
@endsection
