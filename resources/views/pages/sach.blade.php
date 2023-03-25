@extends('../layout')
{{-- @section('slide')
    @include('pages.slide')
@endsection --}}
@section('content')
    <h3 style="text-align: center; color:blueviolet;" class="p-3">Sách mới 1 cập nhật</h3>
    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row">
                @foreach ($sach as $key => $value)
                    <div class="col-md-3">
                        <div class="card mb-3 box-shadow">
                            <img class="card-img-top" src="{{ asset('public/uploads/sach/' . $value->hinhanh) }}"
                                alt="Card image cap">
                            <div class="card-body">
                                <h5>{{ $value->tensach }}</h5>
                                <p class="card-text">
                                    @php
                                        $tomtat = substr($value->tomtat, 0, 80);
                                    @endphp
                                    {{ $tomtat . '.....' }}
                                </p>
                                <div class="d-flex justify-content-between align-items-center card-body">
                                    <div class="btn-group">
                                        <form>
                                            @csrf

                                            <!-- Button trigger modal -->
                                            <div class="btn-group">
                                                <button  type="button" id="{{ $value->id }}"
                                                    class="btn btn-primary xemsachnhanh"  data-bs-toggle="modal"
                                                    data-bs-target="#staticBackdrop">
                                                    Xem nhanh sách
                                                </button>
                                                <a class="btn btn-sm btn-outline-secondary"><i class="fa-sharp fa-solid fa-eye"></i>
                                                    123000 </p></a>
                                            </div>
                                            {{-- class="container-fluid main_container" --}}

                                            <!-- Modal -->
                                            <div class="modal fade container-fluid " id="staticBackdrop" data-bs-backdrop="static"
                                                data-bs-keyboard="false" tabindex="-1"
                                                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="staticBackdropLabel">
                                                                <div id="tieude_sach"></div>
                                                            </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body row">
                                                            <div id="noidung_sach" class="card-body"></div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <button type="button"
                                                                class="btn btn-primary">Understood</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        {{-- <a href="{{ route('xemsach', $value->slug_sach) }}"
                                            class="btn btn-sm btn-outline-secondary">Đọc ngay</a> --}}
                                        {{-- url('xem-sach/'.$value->slug_sach) --}}
                                        {{-- <a class="btn btn-sm btn-outline-secondary" style="border-radius: 25px;"><i class="fa-sharp fa-solid fa-eye"></i>
                                            <p class=""> 12 </p> </a> --}}
                                    </div>
                                    <small class="text-muted p-2">
                                            <p>{{ $value->created_at->diffForHumans() }}</p>
                                        </td></small>
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
    <h3 style="text-align: center; color:blueviolet">Sách hay xem nhiều</h3>
    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="card mb-3 box-shadow">
                        <img class="card-img-top" src="{{ asset('public/uploads/sach/2b53fb5117a9ea9b770130ff07fe4.jpg') }}"
                            alt="Card image cap">
                        <div class="card-body">
                            <p class="card-text">This is a wider card with supporting text below as a natural
                                lead-in to additional content. This content is a little bit longer.</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <a href="" class="btn btn-sm btn-outline-secondary">Đọc ngay</a>
                                    <a class="btn btn-sm btn-outline-secondary"><i class="fa-sharp fa-solid fa-eye"></i>
                                        123000 </p></a>
                                </div>
                                <small class="text-muted">9 mins agos</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <a class="btn btn-success" href=""> Xem tất cả</a>
        </div>
    </div>
    <!----------------Blog-------------------->
    <h3 style="text-align: center; color:blueviolet">Blog</h3>
    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="card mb-3 box-shadow">
                        <img class="card-img-top" src="{{ asset('public/uploads/sach/2b53fb5117a9ea9b770130ff07fe4.jpg') }}"
                            alt="Card image cap">
                        <div class="card-body">
                            <p class="card-text">This is a wider card with supporting text below as a
                                natural lead-in to additional content. This content is a little bit longer.
                            </p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <a href="" class="btn btn-sm btn-outline-secondary">Đọc
                                        ngay</a>
                                    <a class="btn btn-sm btn-outline-secondary"><i class="fa-sharp fa-solid fa-eye"></i>
                                        123000 </p></a>
                                </div>
                                <small class="text-muted">9 mins agos</small>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-3">
                    <div class="card mb-3 box-shadow">
                        <img class="card-img-top" src="{{ asset('public/uploads/sach/2b53fb5117a9ea9b770130ff07fe4.jpg') }}"
                            alt="Card image cap">
                        <div class="card-body">
                            <p class="card-text">This is a wider card with supporting text below as a
                                natural lead-in to additional content. This content is a little bit longer.
                            </p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <a href="" class="btn btn-sm btn-outline-secondary">Đọc
                                        ngay</a>
                                    <a class="btn btn-sm btn-outline-secondary"><i class="fa-sharp fa-solid fa-eye"></i>
                                        123000 </p></a>
                                </div>
                                <small class="text-muted">9 mins agos</small>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-3">
                    <div class="card mb-3 box-shadow">
                        <img class="card-img-top"
                            src="{{ asset('public/uploads/sach/2b53fb5117a9ea9b770130ff07fe4.jpg') }}"
                            alt="Card image cap">
                        <div class="card-body">
                            <p class="card-text">This is a wider card with supporting text below as a
                                natural lead-in to additional content. This content is a little bit longer.
                            </p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <a href="" class="btn btn-sm btn-outline-secondary">Đọc
                                        ngay</a>
                                    <a class="btn btn-sm btn-outline-secondary"><i class="fa-sharp fa-solid fa-eye"></i>
                                        123000 </p></a>
                                </div>
                                <small class="text-muted">9 mins agos</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card mb-3 box-shadow">
                        <img class="card-img-top"
                            src="{{ asset('public/uploads/sach/2b53fb5117a9ea9b770130ff07fe4.jpg') }}"
                            alt="Card image cap">
                        <div class="card-body">
                            <p class="card-text">This is a wider card with supporting text below as a
                                natural lead-in to additional content. This content is a little bit longer.
                            </p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <a href="" class="btn btn-sm btn-outline-secondary">Đọc
                                        ngay</a>
                                    <a class="btn btn-sm btn-outline-secondary"><i class="fa-sharp fa-solid fa-eye"></i>
                                        123000 </p></a>
                                </div>
                                <small class="text-muted">9 mins agos</small>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <a class="btn btn-success" href=""> Xem tất cả</a>
        </div>

    </div>
@endsection
