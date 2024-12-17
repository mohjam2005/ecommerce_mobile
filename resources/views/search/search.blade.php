<html lang="en" dir="rtl"><link type="text/css" rel="stylesheet" id="dark-mode-custom-link"><link type="text/css" rel="stylesheet" id="dark-mode-general-link"><style lang="en" type="text/css" id="dark-mode-custom-style"></style><style lang="en" type="text/css" id="dark-mode-native-style"></style><!--<![endif]--><!-- BEGIN HEAD --><head>
    <meta charset="utf-8"> 
    <title>  الاستعلام عن خلو طرف </title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport">

    
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> --}}
    <link href="{{ URL::asset('assets/css/bootstrap1.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/css/components-rtl.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/css/layout-rtl.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/css/darkblue-rtl.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/css/custom-rtl.min.css') }}" rel="stylesheet" />
 

    <script src="{{ URL::asset('assets/js/jquery.min.js') }}"></script>

     <!-- END HEAD -->

    
    <style>
        .portlet.box.green>.portlet-title, .portlet.green, .portlet>.portlet-body.green {
    background-color: #09669f;
}
        .my_header {

            height: 50px;
            background-color: #2b3643 !important;
            border-bottom: 1px solid #3D3D3D;

        }
        .page-header.navbar {

            margin: 53px 0 0 0;
            height: 50px;
            position: absolute;

        }

        #imgload
        {
            width: 150px;
            height: 150px;
            padding: 5px;
            text-align: center;
            position: fixed;
            margin-left: -75px;
            margin-top: -75px;
            left: 50%;
            top: 20%;
            z-index: 100;
        }
 
    </style>

</head><body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">


    <div class="page-wrapper">

        <div class="my_header">
            <div class="right_logo"></div>
            <div class="mini_title col-md-4">وزارة النقل والمواصلات </div>
         </div>
        <!-- BEGIN HEADER -->
        <div class="page-header navbar navbar-fixed-top">
            <!-- BEGIN HEADER INNER -->
            <div class="page-header-inner">
                <!-- BEGIN LOGO -->
                <div class="page-logo">
                    <a href="#" style="color: #fff; text-decoration: none;margin-top: 15px;"> الاستعلام  المركزي</a>

                    <!--                        <label   style="color:#FFF; padding-top: 7%; ">
                                                إستعلاماتي </label>-->

                </div>
                <!-- END LOGO -->
                <!-- BEGIN RESPONSIVE MENU TOGGLER -->

                <!-- END RESPONSIVE MENU TOGGLER -->
                <!-- BEGIN TOP NAVIGATION MENU -->
                <div class="top-menu">
                    




                        <!-- BEGIN USER LOGIN DROPDOWN -->

                         <!-- END USER LOGIN DROPDOWN -->

                    
                </div>
                <!-- END TOP NAVIGATION MENU -->
            </div>
            <!-- END HEADER INNER -->
        </div>
        <!-- END HEADER -->
        <!-- BEGIN HEADER & CONTENT DIVIDER -->
        <div class="clearfix"> </div>
        <!-- END HEADER & CONTENT DIVIDER -->
        <!-- BEGIN CONTAINER -->
        <div class="page-container">
            <!-- BEGIN SIDEBAR -->
            

            <!-- END SIDEBAR -->
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content" style="margin-right: 0px; min-height: 367px;">
                    <!-- BEGIN PAGE HEADER-->
                    <center>
                        <img id="imgload" style="display: none;" width="200px" height="200px" src="https://query.gov.ps//assets/layouts/layout/img/spinner.gif">
                    </center>

                     <!-- END PAGE BAR -->
                    <!-- BEGIN PAGE TITLE-->

                    <!-- END PAGE TITLE-->
                    <!-- END PAGE HEADER-->




                    
<style>
.dropdown-menu{
    z-index: 10000;
}
</style>

<div class="row">
<div class="col-md-10">
 </div>
<div class="col-md-2">

   <!--  <button  type="button" class="btn" onclick=" location.reload();" >عودة للرئيسية</button> -->

</div>
</div>
<br>
<div class="portlet box green">
<div class="portlet-title">
    <div class="caption"><i class="icon-reorder"></i>شاشة استعلام عن الخلوات الضريبية</div>
    <div class="tools">
        <a href="javascript:;" class="collapse"></a>
    </div>
</div>

<div class="portlet-body form" id="ajaxLoad">
    <div class="d-flex align-items-center justify-content-center" align="center">
        <div class="p-2 bd-highlight col-example">
            <!-- BEGIN FORM-->
            <form id="form_sample_3" class="form-horizontal" >
 
                <div class="form-body">

                     <div class="form-group">
                        <label class="control-label col-md-4"> الهوية  </label>
                        <div class="col-md-5">
                            <div class="input-group">
                                <input maxlength="9" name="ID" id="ID"  class="form-control" style=" text-align: center">
                                @if ($errors->has('ID'))
                                <span class="text-danger">{{ $errors->first('ID') }}</span>
                                @endif
                            </div>
                            
                        </div>
                        <div class="col-md-1 " >
                            <button id="viewBtn" name="viewBtn" type="button" class="btn green" > <i class="icon-search" style="padding-left:7px"></i>استعلام</button>

                        </div>

                    </div>

                    <div   class="form-group" style="float: left">

                     


                        <div class="col-md-12 " >
 
                        </div>

                    </div>


                </div>


                <!--                    <div class="form-actions fluid">
                                        <div class="row">
                                            <div class="col-md-12" style="text-align:center">
                                            </div>
                                        </div>
                                    </div>-->

            </form>

        </div>
        
        


        <div  class="p-2 bd-highlight col-example" >
 
            <div class="input-group">
                <label style="border: none;color:red;font-weight: bold" type="text" name="info" id="info"></label>

            {{-- <input disabled style="border: none;color:red;font-weight: bold" type="text" name="info" id="info"> --}}
            </div>
 
            {{-- <div class="input-group">

                <label style="border: none;color:royalblue;  font-weight: bold" type="text" name="name" id="name" size="30"></label>
            </div> --}}
                <div class="input-group">

                    <label style="border: none;color:royalblue;  font-weight: bold" type="text" name="IDC" id="IDC" size="30"></label>
                </div>
                <div class="input-group">

                    <label style="" type="text" name="TAX_MAX_DT" id="TAX_MAX_DT" size="30"></label>
                </div>
                <div class="input-group">

                    <label style="border: none;color:royalblue;  font-weight: bold" type="text" name="TAX_STATUS" id="TAX_STATUS" size="30"></label>
                </div>
                <div class="input-group">

                    <label style=" " type="text" name="VAT_MAX_DT" id="VAT_MAX_DT" size="30"></label>
                </div>
                <div class="input-group">

                    <label style="border: none;color:royalblue;  font-weight: bold" type="text" name="VAT_STATUS" id="VAT_STATUS" size="30"></label>
                </div>
                
                <div class="input-group">

                    <label style="border: none;color:rgb(225, 65, 65);  font-weight: bold" type="text" name="VACCINATION_TYPE" id="VACCINATION_TYPE" size="30"></label>
                </div>

                
        </div>
        <!-- END FORM-->  

    </div>
</div>



</div>
<!-- BEGIN EXAMPLE TABLE PORTLET-->

<div class="row">
<div class="col-md-12">

    <div class="portlet light portlet-fit portlet-datatable bordered">
        {{-- <div class="portlet-body" name="arab_name" id="arab_name" style="display: block;"><span style="color:red"> </span></div> --}}
    </div>
</div>
 
</div>
<script type="text/javascript">

$(document).on('keypress',function(e) {

    if(e.which == 13) {
        check();
        e.preventDefault();

    }
});


</script>
<script type="text/javascript">

 function check(){
    var text = $('#txtSearch').val();
    
    $.ajax({

        type:"GET",
        url: '{{ route("searching") }}',
        data: {text: $('#ID').val()},
        dataType: "json",

        success: function(response) {
              console.log(response);
           
                if(response['error']){
                $("#info").show();
                $('#info').css("color", "red").text(response['error']); 
                $('#IDC').hide();
                $('#TAX_MAX_DT').hide();
                $('#TAX_STATUS').hide();
                $('#VAT_MAX_DT').hide();
                $('#VAT_STATUS').hide();
 

                }
                else{
                    // ||typeof(response['0']['DATA']['IDC'])=="undefined"
             if(response['0']==''){
                $("#info").show();
                $('#info').css("color", "red").text('حاول مرة أخرى '); 
                $('#IDC').hide();
                $('#TAX_MAX_DT').hide();
                $('#TAX_STATUS').hide();
                $('#VAT_MAX_DT').hide();
                $('#VAT_STATUS').hide();

                // $('#StudID').val('');  
                // $('#exam_count').val('');  

            }
            else{

                 $('#info').css("color", "green").text('بيانات المشغل'); 
                $('#IDC').show();
                $('#TAX_MAX_DT').show();
                $('#TAX_STATUS').show();
                $('#VAT_MAX_DT').show();
                $('#VAT_STATUS').show();
///////////////// اظهار البيانات 
  //  "TAX_MAX_DT": "آخر خلو طرف الدخل",

            // "TAX_STATUS": "حالة خلو دخل",

            // "TAX_FLAGS": "كود حالة خلو الدخل",

            // "VAT_MAX_DT": "آخر خلو طرف المضافة",

            // "VAT_STATUS": "حالة خلو المضافة",
            var TAX_FLAGS  =response['0']['DATA']['TAX_FLAGS'];
            var VAT_FLAGS  =response['0']['DATA']['VAT_FLAGS'];
            
               
                $('#IDC').text("رقم الهوية:"+response['0']['DATA']['IDC']);
                

                if(TAX_FLAGS==0){
                   
                $('#TAX_MAX_DT')
                 .css({
                    'border' : 'none',
                    'color' : 'rgb(255, 255, 255)',
                    'font-weight' : 'bold',
                    'background-color' : 'red'

                    })
                 .text("آخر خلو طرف الدخل:"+response['0']['DATA']['TAX_MAX_DT']);
                    }
                    else{
             $('#TAX_MAX_DT')
                 .css({
                    'border' : 'none',
                    'color' : 'rgb(255, 255, 255)',
                    'font-weight' : 'bold',
                    'background-color' : 'green'

                    })
                 .text("آخر خلو طرف الدخل:"+response['0']['DATA']['TAX_MAX_DT']);
                    }
               
                $('#TAX_STATUS').text("حالة خلو دخل:"+response['0']['DATA']['TAX_STATUS']);
               

                if(VAT_FLAGS==0){
            $('#VAT_MAX_DT')
                 .css({
                    'border' : 'none',
                    'color' : 'rgb(255, 255, 255)',
                    'font-weight' : 'bold',
                    'background-color' : 'red'

                    })
                 .text("آخر خلو طرف المضافة:"+response['0']['DATA']['VAT_MAX_DT']);
                }
                else{
                    $('#VAT_MAX_DT')
                 .css({
                    'border' : 'none',
                    'color' : 'rgb(255, 255, 255)',
                    'font-weight' : 'bold',
                    'background-color' : 'red'

                    })
                 .text("آخر خلو طرف المضافة:"+response['0']['DATA']['VAT_MAX_DT']);
                }
               


                $('#VAT_STATUS').text(" حالة خلو المضافة:"+response['0']['DATA']['VAT_STATUS']);


                

            }
        
            
                } 
         }



    });
 }
    
    //  $('#submitform').on('click', function () {
       
    //     check();
    //    //completed();
    //  //  redirect();
    //   });
       
     
    
        
    
     
    $("#viewBtn").click(function(){
        check();
            });
    
    
    
     
     
    
    
    </script>
    

 









                     

                </div>
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->
        </div>
        <!-- END CONTAINER -->
        <!-- BEGIN FOOTER -->
        <div class="page-footer">
            <div class="footer-inner" style="color: #999999">
                تطوير الادارة العامة للحاسوب  | وزارة النقل والمواصلات  © 2022 
            </div>
            <div class="scroll-to-top" style="display: block;">
                <i class="icon-arrow-up"></i>
            </div>
        </div>
        <!-- END FOOTER -->
    </div>


    <div class="modal fade" id="large" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title" id="large_moadl_title"></h4>
                </div>
                <div class="modal-body" id="large_moadl_msg"></div>
                <div class="modal-footer">
                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">اغلاق</button>
                    <!--                        <button type="button" class="btn green">Save changes</button>-->
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="basic" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title" id="basic_moadl_title"></h4>
                </div>
                <div class="modal-body" id="basic_moadl_msg"></div>
                <div class="modal-footer">
                    <button type="button" id="basic_moadl_btn" class="btn dark btn-outline" data-dismiss="modal">اغلاق</button>
                    <!--                        <button type="button" class="btn green">Save changes</button>-->
                </div>
            </div>
        </div>
    </div>

 
    <script src="{{ URL::asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/jquery-ui.min.js') }}"></script>

  
     
 



    <!-- END THEME GLOBAL SCRIPTS -->


    <script type="text/javascript">

        $(document).ready(function () {
            App.init();
            // TableManaged.init();
        });
        var $loading = $('#imgload').hide();
        $(document)
                .ajaxStart(function () {
                    $loading.show();
                })
                .ajaxStop(function () {
                    $loading.hide();
                });
        $('.date').datepicker({
            'autoclose': true
        });
        $('.start_dt').datepicker({
            'autoclose': true
        });
        $('.end_dt').datepicker({
            startDate: "'/" + $('.start_dt').val() + "'/",
            'autoclose': true
        });
        $('.specific-date').datepicker({
            //startDate: '+1d',
            endDate: '+d',
            'autoclose': true
        });
        $('.date-picker').datepicker({
            'autoclose': true,
            'format': 'dd/mm/yyyy'

        });
    </script>





   
     


<div role="log" aria-live="assertive" aria-relevant="additions" class="ui-helper-hidden-accessible"></div></body></html>