<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'ChatApp') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        nav{
            background-color: rgb(0, 71, 171);
        }

        .modal-body, .modal-footer{
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /*Modal buttons*/

        #logout-button{
            background-color:white !important;
            color:rgb(1, 100, 32);
            border: 2px solid rgb(1, 100, 32);
            border-radius: 10px;
            width: 15%;
        }

        #logout-button:hover{
            background-color: rgb(1, 100, 32) !important;
            color:white;
            border: 2px solid rgb(1, 100, 32);
            border-radius: 10px;
        }


        #stay-button{
            background-color:white !important;
            color:rgb(139, 0, 0);
            border: 2px solid rgb(139, 0, 0);
            border-radius: 10px;
            width: 15%;
        }

        #stay-button:hover{
            background-color: rgb(139, 0, 0) !important;
            color:white;
            border: 2px solid rgb(139, 0, 0);
            border-radius: 10px;
        }

        .col_white_amrc {
            color: #FFF;
        }

        footer {
            width:100%;
            background-color:rgb(0, 71, 171);
            min-height:250px;
            padding:10px 0px 25px 0px ;
        }

        .pt2 { padding-top:40px ; margin-bottom:20px ;}
        footer p { font-size:13px; color:white; padding-bottom:0px; margin-bottom:8px;}
        .mb10 { padding-bottom:15px ;}
        .footer_ul_amrc { margin:0px ; list-style-type:none ; font-size:14px; padding:0px 0px 10px 0px ; }
        .footer_ul_amrc li {padding:0px 0px 5px 0px;}
        .footer_ul_amrc li a{ color:white;}
        .footer_ul_amrc li a:hover{ color:#fff; text-decoration:none;}
        .fleft { float:left;}
        .padding-right { padding-right:10px; }

        .footer_ul2_amrc {margin:0px; list-style-type:none; padding:0px;}
        .footer_ul2_amrc li p { display:table; }
        .footer_ul2_amrc li a:hover { text-decoration:none;}
        .footer_ul2_amrc li i { margin-top:5px;}

        .bottom_border { border-bottom:1px solid #323f45; padding-bottom:20px;}
        .foote_bottom_ul_amrc {
            list-style-type:none;
            padding:0px;
            display:table;
            margin-top: 10px;
            margin-right: auto;
            margin-bottom: 10px;
            margin-left: auto;
        }
        .foote_bottom_ul_amrc li { display:inline;}
        .foote_bottom_ul_amrc li a { color:white; margin:0 12px;}

        .social_footer_ul { display:table; margin:15px auto 0 auto; list-style-type:none;  }
        .social_footer_ul li { padding-left:20px; padding-top:10px; float:left; }
        .social_footer_ul li a { color:#CCC; border:1px solid #CCC; padding:8px;border-radius:50%;}
        .social_footer_ul li i {  width:20px; height:20px; text-align:center;}

        a{
            text-decoration: none;
        }

    </style>

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md shadow-sm">
            <div class="container">
                <a class="navbar-brand text-white" href="{{ url('/') }}">
                    {{ config('app.name', 'ChatApp') }}
                </a>
                <a class="nav-link text-white"  href="{{ route('home') }}" >
                    Home
                </a>
                <a class="nav-link text-white ms-3"  href="{{ route('friends') }}" >
                    Friends
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

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
                                    <a class="nav-link text-white" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
{{--                                    <a class="dropdown-item" href="{{ route('logout') }}"--}}
{{--                                       onclick="event.preventDefault();--}}
{{--                                                     document.getElementById('logout-form').submit();">--}}
{{--                                        {{ __('Logout') }}--}}
{{--                                    </a>--}}
                                    <a class="dropdown-item" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                       Log out
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <div class="modal fade " id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Log out</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h3>Are you sure you want to log out?</h3>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn" id="logout-button" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"
                                {{ __('Logout') }}>Yes</button>
                        <button type="button" class="btn" id="stay-button" data-bs-dismiss="modal">No</button>
                    </div>
                </div>
            </div>
        </div>
        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <footer class="footer mt-5">
        <div class="container bottom_border">
            <div class="row ms-5 mt-2 mb-2">
                <div class=" col-sm-4 col-md col-sm-4  col-12 col">
                    <h5 class="headin5_amrc col_white_amrc pt2 text-white">Find us</h5>
                    <p class="mb10">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>
                    <p><i class="fa fa-location-arrow"></i> 9878/25 sec 9 rohini 35 </p>
                    <p><i class="fa fa-phone"></i>  +91-9999878398  </p>
                    <p><i class="fa fa fa-envelope"></i> info@example.com  </p>
                </div>


                <div class=" col-sm-4 col-md  col-6 col">
                    <h5 class="headin5_amrc col_white_amrc pt2 text-white" >Quick links</h5>
                    <!--headin5_amrc-->
                    <ul class="footer_ul_amrc">
                        <li><a href="http://webenlance.com">Image Rectoucing</a></li>
                        <li><a href="http://webenlance.com">Clipping Path</a></li>
                        <li><a href="http://webenlance.com">Hollow Man Montage</a></li>
                        <li><a href="http://webenlance.com">Ebay & Amazon</a></li>
                        <li><a href="http://webenlance.com">Hair Masking/Clipping</a></li>
                        <li><a href="http://webenlance.com">Image Cropping</a></li>
                    </ul>
                    <!--footer_ul_amrc ends here-->
                </div>


                <div class=" col-sm-4 col-md  col-6 col">
                    <h5 class="headin5_amrc col_white_amrc pt2 text-white">About</h5>
                    <!--headin5_amrc-->
                    <ul class="footer_ul_amrc">
                        <li><a href="http://webenlance.com">Remove Background</a></li>
                        <li><a href="http://webenlance.com">Shadows & Mirror Reflection</a></li>
                        <li><a href="http://webenlance.com">Logo Design</a></li>
                        <li><a href="http://webenlance.com">Vectorization</a></li>
                        <li><a href="http://webenlance.com">Hair Masking/Clipping</a></li>
                        <li><a href="http://webenlance.com">Image Cropping</a></li>
                    </ul>
                    <!--footer_ul_amrc ends here-->
                </div>


                <div class=" col-sm-4 col-md  col-12 col">
                    <h5 class="headin5_amrc col_white_amrc pt2 text-white">Follow us</h5>

                    <ul class="footer_ul2_amrc">
                        <li><a href="#"></a><a href="#" class="text-white">Facebook</a></li>
                        <li><a href="#"></a><a href="#" class="text-white">Instagram</a></li>
                        <li><a href="#"></a><a href="#" class="text-white">Twitter</a></li>
                      </ul>
                    <!--footer_ul2_amrc ends here-->
                </div>
            </div>
        </div>


        <div class="container mt-3 mb-3">
            <ul class="foote_bottom_ul_amrc mt-b-3">
                <li><a href="http://webenlance.com">Home</a></li>
                <li><a href="http://webenlance.com">About</a></li>
                <li><a href="http://webenlance.com">Friends</a></li>
                <li><a href="http://webenlance.com">Pricing</a></li>
                <li><a href="http://webenlance.com">Blog</a></li>
                <li><a href="http://webenlance.com">Contact</a></li>
            </ul>

            <p class="text-center">Copyright @2022 | Designed by <a href="#" class="text-white">ChatApp Team</a></p>
        </div>

    </footer>
</body>
</html>
