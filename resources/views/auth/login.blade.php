@extends('layouts.master-admin-login')
@section('title')
تسجيل دخول - موقع التجارة الالكترونية
@stop

@section('css')
<style>

.wrap {
}

.item {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  width: 100%;
  
}
</style>
    <!-- Sidemenu-respoansive-tabs css -->
    <link href="{{URL::asset('assets/plugins/sidemenu-responsive-tabs/css/sidemenu-responsive-tabs.css')}}" rel="stylesheet">
@endsection
@section('content')

    <div class="container-fluid">
        
        <div class="row ">
            
            <div class="col-md-6 col-lg-6 col-xl-5 bg-white">

                <div class="row wd-700p mx-auto text-center">
                <div data-tilt data-tilt-startX="10" data-tilt-startY="-10">
                    <img style="max-width: 400px; max-height:400px;margin-top:100px" src="{{URL::asset('assets/img/brand/img.png')}}" alt="">
            
            
          
                </div>
            </div>
            </div>
     
       
            <!-- The image half -->
            <!-- The content half -->
            <div class="col-md-7 col-lg-7 col-xl-7 bg-white">
                <div class="login d-flex align-items-center py-2">
                    <!-- Demo content-->
                    <div class="container p-0">
                        <div class="row">
                            <div class="col-md-10 col-lg-10 col-xl-9 mx-auto">
                                <div class="card-sigin">
                                 
                                    <div class="mb-5 d-flex"> <a href="{{ url('/' . $page='Home') }}"><img style="max-width: 200px; max-height:200px;margin-top:100px"  src="{{URL::asset('assets/img/brand/nagel.png')}}" class="sign-favicon ht-100" alt="logo"></a></div>
                                    
                                    <div class="card-sigin">
                                        <div class="main-signup-header" style="text-align: right">
                                            <h2>مرحبا بك</h2>
                                            <h5 class="font-weight-semibold mb-4"> تسجيل الدخول</h5>
                                            <form method="POST" action="{{ route('login') }}">
                                                {{ csrf_field() }}                                                <div class="form-group">
                                                    <label> اسم المستخدم</label>
                                                         <input id="user_name" type="text" class="form-control{{ $errors->has('user_name') ? ' is-invalid' : '' }}" name="user_name" value="{{ old('user_name') }}" required autofocus>
                                                
                                                        @if ($errors->has('user_name'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('user_name') }}</strong>
                                                        </span>
                                                        @endif
                                                     {{-- <input id="user_name" type="text" class="form-control @error('user_name') is-invalid @enderror" name="user_name" value="{{ old('user_name') }}"  autocomplete="user_name" autofocus> --}}
                                                     {{-- @error('user_name')
                                                    <span class="invalid-feedback" role="alert">
                                                     <strong>{{ $message }}</strong>
                                                     </span>
                                                    @enderror --}}
                                                </div>

                                                <div class="form-group">
                                                    <label>كلمة المرور</label>

                                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                                    @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                                  </span>
                                                    @enderror
                                                    <div class="form-group row">
                                                        <div class="col-md-6 offset-md-4">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                <label class="form-check-label" for="remember">
                                                                    {{ __('تذكرني') }}
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div >
                                                <button type="submit" class="btn btn-primary btn-block">
                                                    {{ __('تسجيل الدخول') }}
                                                </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End -->
                </div>
            </div><!-- End -->

            

           
          

            

          
               
               
                   



               

                       
        

                    {{-- <div class="col-md-12 col-lg-12 col-xl-12 my-auto mx-auto wd-100p">
                    </div> --}}
             

        </div>
    </div>
@endsection
@section('js')
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>  --}}
<script src="{{ URL::asset('assets/js/vanilla-tilt.min.js') }}"></script>


@endsection
