<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/owl.carousel.min.css') }}" rel="stylesheet">
    {{-- <link href="{{ asset('css/owl.theme.default.min.css') }}" rel="stylesheet"> --}}
    {{-- <link href="{{ asset('css/owl.theme.default.min.css') }}" rel="stylesheet"> --}}
    <title>Laravel doc truyen sach </title>
    <link type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        rel="stylesheet">
    <style type="text/css">
        ul.mucluctab_truyen {
            list-style: none;
            padding: 0;
            margin: 12px 0;
        }

        ul.mucluctab_truyen li a {
            color: #000;
            text-transform: uppercase;
        }

        h5 {
            /* font-weight: bold;
            line-height: 25px; */
        }

        .switch_color {
            background: #181818;
            color: #fff;
        }

        .switch_color_light {
            background: #181818 !important;
            color: #000;
        }

        .noidung_color {
            color: #000;
        }
    </style>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/fontawesome.min.css">

</head>

<body>

    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#"
                    style="color:rgb(6, 45, 45); background-color:rgb(183, 245, 12); border-radius: 25px;">Moidoc169.com</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ url('/dashboard') }}"><i
                                    class="fa-solid fa-house-user"></i> Trang chủ</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-sharp fa-solid fa-list"></i> Danh mục truyện
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                @foreach ($danhmuc as $key => $danh)
                                    <li><a style="text-transform:capitalize;" class="dropdown-item"
                                            href="{{ url('danh-muc/' . $danh->slug_danhmuc) }}"> <i
                                                class="fa-sharp fa-solid fa-list"></i> {{ $danh->tendanhmuc }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-tag"></i> Thể loại
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                @foreach ($theloai as $key => $the)
                                    <li><a style="text-transform:capitalize;" class="dropdown-item"
                                            href="{{ url('the-loai/' . $the->slug_theloai) }}"><i
                                                class="fa-solid fa-tags p-2"></i>{{ $the->tentheloai }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ url('/doc-sach') }}"><i
                                    class="fa-sharp fa-solid fa-book"></i> Sách</a>
                        </li>

                    </ul>
                    <div class="row">
                        <style>
                            .dropdown-menu li {
                                padding: 5px 15px;
                            }

                            .dropdown-menu li a {

                                /* text-transform: capitalize; */
                                text-transform: lowercase;
                                color: #000;
                            }
                        </style>
                        <div class="col-md-12">
                            <form autocomplete="off" class="d-flex" action="{{ url('tim-kiem') }}" method="POST">
                                @csrf
                                <div class="col-6">
                                    <div class="col-12 p-2">
                                        <input class="form-control me-2" type="search" name="tukhoa" id="keywords"
                                            placeholder="Tìm kiếm truyện, tác giả ..." aria-label="Search">
                                    </div>
                                    <div class="col-12">
                                        <div id="search_ajax" style="position: relative"></div>
                                    </div>

                                </div>
                                <div class="col-4 p-2 ms-1 ">
                                    <button class="btn btn-outline-success" type="submit">Tìm kiếm</button>
                                </div>
                                <select class="custom-sect mr-sm-1 mt-3" style="width: 65px; height:25px;"
                                    name="" id="switch_color">
                                    <option value="xam">Xám</option>
                                    <option value="den">Đen</option>
                                </select>

                            </form>
                        </div>

                    </div>
                    <div class="row">
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <!-- Left Side Of Navbar -->
                            <ul class="navbar-nav me-auto">

                            </ul>

                            <!-- Right Side Of Navbar -->
                            <ul class="navbar-nav ms-auto">
                                <!-- Authentication Links -->
                                @guest
                                    @if (Route::has('login'))
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                        </li>
                                    @endif

                                    @if (Route::has('register'))
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                        </li>
                                    @endif
                                @else
                                    <li class="nav-item dropdown">
                                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#"
                                            role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false" v-pre>
                                            {{ Auth::user()->name }}
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                                 document.getElementById('logout-form').submit();">
                                                {{ __('Logout') }}
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                class="d-none">
                                                @csrf
                                            </form>
                                        </div>
                                    </li>
                                @endguest
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </nav>

        <!----------------slide-------------------->
        @yield('slide')

        <!----------------Sach moi-------------------->
        @yield('content')
        <footer class="text-muted py-5">
            <div class="container">
                <p class="float-end mb-1">
                    <a href="#">Back to top</a>
                </p>
                <p class="mb-1">Album example is &copy; Bootstrap, but please download and customize it for yourself!
                </p>
                <p class="mb-0">New to Bootstrap? <a href="/">Visit the homepage</a> or read our <a
                        href="/docs/5.0/getting-started/introduction/">getting started guide</a>.</p>
            </div>
        </footer>
    </div>




    <script src="{{ asset('js/app.js') }}" defer></script>
    {{-- <script src="{{ asset('js/owl.carousel.js') }}" defer></script> --}}
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

    {{-- <script src="https://cdn.ckeditor.com/ckeditor5/35.4.0/classic/ckeditor.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.9.0/ckeditor.js"></script> --}}

    <script type="text/javascript">
        $(document).on('click', '.xemsachnhanh', function() {
            var sach_id = $(this).attr('id');
            var _token = $('input[name="_token"]').val();
            // alert(sach_id);
            // alert(_token);
            $.ajax({
                url: '{{ url('/xemsachnhanh') }}',
                method: "POST",
                dataType: "JSON",
                data: {
                    sach_id: sach_id,
                    _token: _token
                },
                success: function(data) {
                    $('#tieude_sach').html(data.tieude_sach);
                    $('#noidung_sach').html(data.noidung_sach);
                }
            });
        });
    </script>



    <script type="text/javascript">
        $('.tabs_danhmuc').click(function() {
            const danhmuc_id = $(this).data('danhmuc_id');
            var _token = $('input[name="_token"]').val();

            $.ajax({
                url: '{{ url('/tabs-danhmuc') }}',
                method: "POST",
                data: {
                    _token: _token,
                    danhmuc_id: danhmuc_id
                },
                success: function(data) {
                    $('#tab_danhmuctruyen').html(data);
                }
            })
        })
    </script>
    <script>
        $('#xoayeuthich').click(function() {
            localStorage.clear('yeuthich');
        });
    </script>
    <script type="text/javascript">
        show_wishlist();

        function show_wishlist() {
            if (localStorage.getItem('wishlist_truyen') != null) {
                var data = JSON.parse(localStorage.getItem('wishlist_truyen'));
                data.reverse();
                for (i = 0; i < data.length; i++) {
                    var title = data[i].title;
                    var img = data[i].img;
                    var id = data[i].id;
                    var url = data[i].url;
                    $('#yeuthich').append(
                        `
                        <div class="row mt-2">
                            <div class="col-md-5"><img class="img img-responsive" width="100%" class="card-img-top" src="` + img +
                        `" alt="` + title + `
                                "></div>
                            <div class="col-md-7 sidebar">
                                <a href="` + url + `">
                                <p>` + title + `</p>
                                </a>
                            </div>
                        </div>
                    `);
                }
            }
        }

        $('.btn-thich_truyen').click(function() {
            $('.fa.fa-heart').css('color', '#fac');
            const id = $('.wishlist_id').val();
            const title = $('.wishlist_title').val();
            const img = $('.card-img-top').attr('src');
            const url = $('.wishlist_url').val();
            // alert(id);
            // alert(title);
            // alert(img);
            // alert(url);

            const item = {
                'id': id,
                'title': title,
                'img': img,
                'url': url
            }
            if (localStorage.getItem('wishlist_truyen') == null) {
                localStorage.setItem('wishlist_truyen', '[]');
            }

            var old_data = JSON.parse(localStorage.getItem('wishlist_truyen'));
            var matches = $.grep(old_data, function(obj) {
                return obj.id == id;
            })
            if (matches.length) {
                alert('Truyện đã có trong danh sách yêu thích');
            } else {
                if (old_data.length <= 5) {
                    old_data.push(item);
                } else {
                    alert('Đã đạt tới giới hạn truyện yêu thích');
                }
                $('#yeuthich').append(
                    `
                        <div class="row mt-2">
                            <div class="col-md-5"><img class="img img-responsive" width="100%" class="card-img-top" src="` + img +
                    `" alt="` + title + `
                                "></div>
                            <div class="col-md-7 sidebar">
                                <a href="` + url + `">
                                <p>` + title + `</p>
                                </a>
                            </div>
                        </div>
                    `);
                localStorage.setItem('wishlist_truyen', JSON.stringify(old_data));
                alert('Đã lưu vào danh sách truyện yêu thích');

            }

            localStorage.setItem('wishlist_truyen', JSON.stringify(old_data));
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            if (localStorage.getItem('switch_color') !== null) {
                const data = localStorage.getItem('switch_color');
                const data_obj = JSON.parse(data);
                $(document.body).addClass(data_obj.class_1);
                $('.album').addClass(data_obj.class_2);
                $('.card-body').addClass(data_obj.class_1);
                $('ul.mucluctruyen > li > a').css('color', '#fff');
                $('.sidebar > a').css('color', '#fff');

                $("select option[value='den']").attr("selected", "selected");
            }
        })
        $("#switch_color").change(function() {
            // var color = $(this).val();
            // alert(color);
            $(document.body).toggleClass('switch_color');
            $('.album').toggleClass('switch_color_light');
            $('.card-body').toggleClass('switch_color');
            $('ul.mucluctruyen > li > a').css('color', '#fff');
            $('.sidebar > a').css('color', '#fff');

            if ($(this).val() == 'den') {
                var item = {
                    'class_1': 'switch_color',
                    'class_2': 'switch_color_light'
                }
                localStorage.setItem('switch_color', JSON.stringify(item));
            } else if ($(this).val() == 'xam') {
                localStorage.removeItem('switch_color');
                $('ul.mucluctruyen > li > a').css('color', '#000');
            }

        });
    </script>
    <script type="text/javascript">
        $('#keywords').keyup(function() {
            var keywords = $(this).val();
            // alert(keywords);

            if (keywords != '') {
                var _token = $('input[name="_token"]').val();
                console.log(_token);
                $.ajax({

                    url: "{{ url('/timkiem-ajax') }}",
                    method: "POST",
                    data: {
                        keywords: keywords,
                        _token: _token
                    },
                    success: function(data) {
                        $('#search_ajax').fadeIn();
                        $('#search_ajax').html(data);
                    }
                });
            } else {
                $('#search_ajax').fadeOut();
                // alert('khong vo');
            }
        });
        $(document).on('click', '.li_search_ajax', function() {
            $('#keywords').val($(this).text());
            $('#search_ajax').fadeOut();
        });
    </script>
    <script type="text/javascript">
        $('.owl-carousel').owlCarousel({
            loop: true,
            margin: 10,
            dot: true,
            // nav:true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 5
                }
            }
        })
    </script>
    <script type="text/javascript">
        $('.select-chapter').on('change', function() {
            var url = $(this).val();
            if (url) {
                window.location = url;
            }
            return false;
        });

        current_chapter();

        function current_chapter() {
            var url = window.location.href;
            $('.select-chapter').find('option[value="' + url + '"]').attr("selected", true);
        }
    </script>

    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v15.0"
        nonce="zGsoeVAF"></script>
</body>


</html>
