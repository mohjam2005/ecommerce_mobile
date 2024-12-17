@extends('layouts.master')
@section('title')
    لوحة التحكم - برالعميلج الامتحانات
@stop
@section('css')
    <!--  Owl-carousel css-->
    <link href="{{ URL::asset('assets/plugins/owl-carousel/owl.carousel.css') }}" rel="stylesheet" />
    <!-- Maps css -->
    <link href="{{ URL::asset('assets/plugins/jqvmap/jqvmap.min.css') }}" rel="stylesheet">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <div>
                <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">مرحبا بك</h2>
             </div>
        </div>
         
    </div>
    <!-- /breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row row-sm">
        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-primary-gradient">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-12 text-white">اجمالي عدد الطلاب المختبرين</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                 <h4 class="tx-20 font-weight-bold mb-1 text-white">
                                    @if( session('session_type') == 1)
                                    {{ \App\exam_sessions::where('branch_id',Auth::user()->branch_id)->where('exam_mode',1)->count() }}
                                    @else
                                    {{ \App\exam_sessions::where('branch_id',Auth::user()->branch_id)->where('exam_mode',2)->count() }}

                                    @endif
                                    {{-- {{ number_format(\App\exam_sessions::sum('stud_id'), 2) }} --}}
                                </h4>
                                <p class="mb-0 tx-12 text-white op-7">
                                    
                                    @if( session('session_type') == 1)
                                    {{ \App\exam_sessions::where('branch_id',Auth::user()->branch_id)->where('exam_mode',1)->count() }}
                                    @else
                                    {{ \App\exam_sessions::where('branch_id',Auth::user()->branch_id)->where('exam_mode',2)->count() }}

                                    @endif                                
                                </p>
                            </div>
                            <span class="float-right my-auto mr-auto">
                                <i class="fas fa-arrow-circle-up text-white"></i>
                                <span class="text-white op-7"> </span>
                            </span>
                        </div>
                    </div>
                </div>
                <span id="compositeline" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
            </div>
        </div>
    <!-- row closed -->
<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-success-gradient">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-12 text-white"> الطلاب الناجحون</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h3 class="tx-20 font-weight-bold mb-1 text-white">
                                    @if( session('session_type') == 1)
                                    {{ \App\exam_results::where('branch_id',Auth::user()->branch_id)->where('exam_grade','>=', '25')->where('exam_mode',1)->count()}}
                                    @else
                                    {{ \App\exam_results::where('branch_id',Auth::user()->branch_id)->where('exam_grade','>=', '25')->where('exam_mode',2)->count()}}

                                    @endif

                                </h3>
                                <p class="mb-0 tx-12 text-white op-7">
                                    @if( session('session_type') == 1)
                                    {{ \App\exam_results::where('branch_id',Auth::user()->branch_id)->where('exam_grade','>=', '25')->where('exam_mode',1)->count()}}
                                    @else
                                    {{ \App\exam_results::where('branch_id',Auth::user()->branch_id)->where('exam_grade','>=', '25')->where('exam_mode',2)->count()}}

                                    @endif
                                
                                </p>
                            </div>
                            <span class="float-right my-auto mr-auto">
                                <i class="fas fa-arrow-circle-down text-white"></i>
                                <span class="text-white op-7">

                                    @php
                                    if( session('session_type') == 1){
                                    $count_all= \App\exam_results::where('branch_id',Auth::user()->branch_id)->where('exam_mode',1)->count();
                                    $count_correct = \App\exam_results::where('branch_id',Auth::user()->branch_id)->where('exam_grade','>=','25')->count();
                                    if($count_correct == 0){
                                       echo $count_correct = 0;
                                    }
                                    else{
                                       echo $count_correct = $count_correct / $count_all *100;
                                    }
                                    }else{
                                        $count_all= \App\exam_results::where('branch_id',Auth::user()->branch_id)->where('exam_mode',2)->count();
                                    $count_correct = \App\exam_results::where('branch_id',Auth::user()->branch_id)->where('exam_grade','>=','25')->where('exam_mode',2)->count();
                                    if($count_correct == 0){
                                       echo $count_correct = 0;
                                    }
                                    else{
                                       echo $count_correct = $count_correct / $count_all *100;
                                    }
                                    }

                                
                                    @endphp

                                </span>
                            </span>
                        </div>
                    </div>
                </div>
                <span id="compositeline2" class="pt-1">3,2,4,6,12,14,8,7,14,16,12,7,8,4,3,2,2,5,6,7</span>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-danger-gradient">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-12 text-white"> الطلاب الراسبون</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h3 class="tx-20 font-weight-bold mb-1 text-white">
                                    @if( session('session_type') == 1)
                                    {{ \App\exam_results::where('branch_id',Auth::user()->branch_id)->where('exam_grade','<', '25')->where('exam_mode',1)->count()}}
                                    @else
                                    {{ \App\exam_results::where('branch_id',Auth::user()->branch_id)->where('exam_grade','<', '25')->where('exam_mode',2)->count()}}

                                    @endif

                                </h3>
                                <p class="mb-0 tx-12 text-white op-7"> 
                                    
                                    @if( session('session_type') == 1)
                                    {{ \App\exam_results::where('branch_id',Auth::user()->branch_id)->where('exam_grade','<', '25')->where('exam_mode',1)->count()}}
                                    @else
                                    {{ \App\exam_results::where('branch_id',Auth::user()->branch_id)->where('exam_grade','<', '25')->where('exam_mode',2)->count()}}

                                    @endif
                                
                                </p>
                            </div>
                            <span class="float-right my-auto mr-auto">
                                <i class="fas fa-arrow-circle-down text-white"></i>
                                <span class="text-white op-7">

                                    @php
                                    if( session('session_type') == 1){
                                    $count_all= \App\exam_results::where('branch_id',Auth::user()->branch_id)->where('exam_mode',1)->count();
                                    $count_correct = \App\exam_results::where('branch_id',Auth::user()->branch_id)->where('exam_grade','<=','25')->where('exam_mode',1)->count();
                                    if($count_correct == 0){
                                       echo $count_correct = 0;
                                    }
                                    else{
                                       echo $count_correct = $count_correct / $count_all *100;
                                    }
                                    }else{
                                        $count_all= \App\exam_results::where('branch_id',Auth::user()->branch_id)->where('exam_mode',2)->count();
                                    $count_correct = \App\exam_results::where('branch_id',Auth::user()->branch_id)->where('exam_grade','<','25')->where('exam_mode',2)->count();
                                    if($count_correct == 0){
                                       echo $count_correct = 0;
                                    }
                                    else{
                                       echo $count_correct = $count_correct / $count_all *100;
                                    }
                                    }


                            
                                    @endphp

                                </span>
                            </span>
                        </div>
                    </div>
                </div>
                <span id="compositeline3" class="pt-1">3,2,4,6,12,14,8,7,14,16,12,7,8,4,3,2,2,5,6,7</span>
            </div>
        </div>
    </div>
 
    <!-- row opened -->
    </div>
 
    <!-- row opened -->
       <!-- row closed -->

    </div>
    </div>
    <!-- Container closed -->
@endsection
@section('js')
    <!--Internal  Chart.bundle js -->
    <script src="{{ URL::asset('assets/plugins/chart.js/Chart.bundle.min.js') }}"></script>
    <!-- Moment js -->
    <script src="{{ URL::asset('assets/plugins/raphael/raphael.min.js') }}"></script>
    <!--Internal  Flot js-->
    <script src="{{ URL::asset('assets/plugins/jquery.flot/jquery.flot.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jquery.flot/jquery.flot.pie.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jquery.flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jquery.flot/jquery.flot.categories.js') }}"></script>
    <script src="{{ URL::asset('assets/js/dashboard.sampledata.js') }}"></script>
    <script src="{{ URL::asset('assets/js/chart.flot.sampledata.js') }}"></script>
    <!--Internal Apexchart js-->
    <script src="{{ URL::asset('assets/js/apexcharts.js') }}"></script>
    <!-- Internal Map -->
    <script src="{{ URL::asset('assets/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <script src="{{ URL::asset('assets/js/modal-popup.js') }}"></script>
    <!--Internal  index js -->
    <script src="{{ URL::asset('assets/js/index.js') }}"></script>
    <script src="{{ URL::asset('assets/js/jquery.vmap.sampledata.js') }}"></script>
@endsection
