<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl" style="text-align: right" >
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
    <script src="http://10.12.13.70/exams/voice-files/js/jquery.js"></script>
    
    <!-- Fonts -->
    <!--          data pagination timer       -->
    
<link href="http://10.12.13.70/exams/voice-files/css/simplyCountdown.theme.default.css" rel="stylesheet">
{{-- <link href="{{URL::asset('css/main.css')}}" rel="stylesheet"> --}}
{{-- <link href="{{URL::asset('assets/css/icons.css')}}" rel="stylesheet"> --}}

<!--          data pagination timer       -->
  


    <!-- Styles -->
    <!-- CSS only -->

{{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous"> --}}
{{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css"> --}}
{{-- <link href="https://fonts.googleapis.com/css?family=Merriweather:400,900,900i" rel="stylesheet"> --}}
<!-- JS, Popper.js, and jQuery -->
  {{-- <script src="{{URL::asset('assets/js/popper.min.js')}}"></script> --}}
 <script src="http://10.12.13.70/exams/voice-files/assets/js/bootstrap.min.js"></script>
 
  
<!--          data pagination timer       -->


<script src="http://10.12.13.70/exams/voice-files/js/paginga.jquery.js"></script>

<script src="http://10.12.13.70/exams/voice-files/js/simplyCountdown.min.js"></script>
{{-- <script src="{{URL::asset('assets/js/sweetalert.min.js')}}"></script> --}}






<!--          data pagination timer       -->

<link href="http://10.12.13.70/exams/voice-files/css/app.css" rel="stylesheet">
    {{-- <link href="{{ asset('css/main.css') }}" rel="stylesheet"> --}}

		<style>
			*
			{
				font-family: sans-serif;
			}

			.items div 
			{
                  background-color:rgb(231, 231, 231);

 
				 
				margin: 5px;
				/* padding: 10px; */
                /* min-height: 350px; */

			}

			.pager div
			{
				float: right;
                color: white;
                text-shadow: 2px 2px 4px #000000;
				border: 1px solid gray;
				margin: 5px;
				padding: 10px;

			}

			.pager div.disabled
			{
				opacity: 0.25;
            }
            .pager .pageNumbers 
			{
                visibility: hidden;
                margin-right: 5%;
                
			
			}

			.pager .pageNumbers a
			{
                visibility: hidden;
				display: inline-block;
				padding: 0 10px;
                color:white;
               
               
			}

			.pager .pageNumbers a.active
			{
				color:teal;
			}

			.pager 
			{
				overflow: hidden;
			}

			.paginate-no-scroll .items div
			{
				height: 350px;
			}

      
        </style>
        @stack('scripts-footer')

</head>
<body>
    <div id="app">
        {{-- <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                
                  برالعميلج الامتحانات الشفوي
               
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        
                        <li>
                            @if(Auth::user())
                                @if(Auth::user()->role == 'admin')
                                    <a class="nav-link" href="{{ route('adminpanel.index') }}">{{ __('Admin Panel') }}</a>
                                @endif
                            @endif
                        </li>
                        <!-- Authentication Links -->
                        {{-- @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('تسجيل الدخول') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('تسجيل') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                                <button>logout</button>
                            </form>
                        @endguest --}}
                    {{-- </ul>
                </div>
            </div>
        </nav>  --}}

        <main class="py-0">
            @yield('content')
        </main>
    </div>

 <script>

 
 </script>
</body>
</html>
