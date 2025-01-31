@extends('backend.layouts.master')
@section('title','اعلانات')
@section('main-content')
 <!-- مثال DataTales -->
 <div class="card shadow mb-4">
     <div class="row">
         <div class="col-md-12">
            @include('backend.layouts.notification')
         </div>
     </div>
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary float-left">الاعلانات</h6>
      <a href="{{route('banner.create')}}" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="اضافة"><i class="fas fa-plus"></i>انشاء اعلان </a>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        @if(count($banners)>0)
        <table class="table table-bordered" id="banner-dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>الرقم</th>
              <th>عنوان</th>
              <th>اختصار</th>
              <th>صورة</th>
              <th>الحالة</th>
              <th>عملیات</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>الرقم</th>
              <th>عنوان</th>
              <th>اختصار</th>
              <th>صورة</th>
              <th>الحالة</th>
              <th>عملیات</th>
              </tr>
          </tfoot>
          <tbody>
            @foreach($banners as $banner)   
                <tr>
                    <td>{{$banner->id}}</td>
                    <td>{{$banner->title}}</td>
                    <td>{{$banner->slug}}</td>
                    <td>
                        @if($banner->photo)
                            <img src="{{asset('Attachments/'.$banner->photo)}}" class="img-fluid zoom" style="max-width:80px ; max-height:80px" alt="{{$banner->photo}}">
                        @else
                            <img src="{{asset('backend/img/thumbnail-default.jpg')}}" class="img-fluid zoom" style="max-width:100%" alt="avatar.png">
                        @endif
                    </td>
                    <td>
                        @if($banner->status=='active')
                            <span class="badge badge-success">{{$banner->status}}</span>
                        @else
                            <span class="badge badge-warning">{{$banner->status}}</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{route('banner.edit',$banner->id)}}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="تعديل" data-placement="bottom"><i class="fas fa-edit"></i></a>
                        <form method="POST" action="{{route('banner.destroy',[$banner->id])}}">
                          @csrf 
                          @method('delete')
                              <button class="btn btn-danger btn-sm dltBtn" data-id={{$banner->id}} style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="حذف"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    </td>
                    {{-- مودال حذف --}}
                    {{-- <div class="modal fade" id="delModal{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="#delModal{{$user->id}}Label" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="#delModal{{$user->id}}Label">حذف مستخدم</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="بستن">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <form method="post" action="{{ route('banners.destroy',$user->id) }}">
                                @csrf 
                                @method('delete')
                                <button type="submit" class="btn btn-danger" style="margin:auto; text-align:center">حذف دائمی مستخدم</button>
                              </form>
                            </div>
                          </div>
                        </div>
                    </div> --}}
                </tr>  
            @endforeach
          </tbody>
        </table>
        <span style="float:right">{{$banners->links()}}</span>
        @else
          <h6 class="text-center">هیچ بنری یافت نشد!!! لطفاً بنر ایجاد کنید</h6>
        @endif
      </div>
    </div>
</div>
@endsection

@push('styles')
  <link href="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
  <style>
      div.dataTables_wrapper div.dataTables_paginate{
          display: none;
      }
      .zoom {
        transition: transform .2s; /* انیمیشن */
      }

      .zoom:hover {
        transform: scale(3.2);
      }
  </style>
@endpush

@push('scripts')

  <!-- افزونه‌های سطح صفحه -->
  <script src="{{asset('backend/vendor/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

  <!-- اسکریپت‌های الطلبی سطح صفحه -->
  <script src="{{asset('backend/js/demo/datatables-demo.js')}}"></script>
  <script>
      
      $('#banner-dataTable').DataTable( {
            "columnDefs":[
                {
                    "orderable":false,
                    "targets":[3,4,5]
                }
            ]
        } );

        // هشدار شیرین

        function deleteData(id){
            
        }
  </script>
  <script>
      $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
          $('.dltBtn').click(function(e){
            var form=$(this).closest('form');
              var dataID=$(this).data('id');
              // alert(dataID);
              e.preventDefault();
              swal({
                    title: "آیا مطمئن هستید؟",
                    text: "پس از حذف، قادر به بازیابی این داده نخواهید بود!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                       form.submit();
                    } else {
                        swal("داده‌های شما امن است!");
                    }
                });
          })
      })
  </script>
@endpush