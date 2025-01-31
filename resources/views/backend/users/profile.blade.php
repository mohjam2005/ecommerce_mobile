@extends('backend.layouts.master')

@section('title','البروفايل مدیر')

@section('main-content')

<div class="card shadow mb-4">
    <div class="row">
        <div class="col-md-12">
           @include('backend.layouts.notification')
        </div>
    </div>
   <div class="card-header py-3">
     <h4 class="font-weight-bold">البروفايل</h4>
     <ul class="breadcrumbs">
         <li><a href="{{route('admin')}}" style="color:#999">داشبورد</a></li>
         <li><a href="" class="active text-primary">صفحه البروفايل</a></li>
     </ul>
   </div>
   <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="image">
                        @if($profile->photo)
 
                        <img class="card-img-top img-fluid rounded-circle mt-4" style="border-radius:50%;height:80px;width:80px;margin:auto;" src="{{asset('Attachments/'.$profile->photo)}}" alt="صورة البروفايل">
                        @else 
                        <img class="card-img-top img-fluid rounded-circle mt-4" style="border-radius:50%;height:80px;width:80px;margin:auto;" src="{{asset('backend/img/avatar.png')}}" alt="صورة البروفايل">
                        @endif
                    </div>
                    <div class="card-body mt-4 ml-2">
                      <h5 class="card-title text-left"><small><i class="fas fa-user"></i> {{$profile->name}}</small></h5>
                      <p class="card-text text-left"><small><i class="fas fa-envelope"></i> {{$profile->email}}</small></p>
                      <p class="card-text text-left"><small class="text-muted"><i class="fas fa-hammer"></i>   @if (!empty($profile->getRoleNames()))
                        @foreach ($profile->getRoleNames() as $v)
                            <label class="badge badge-success">{{ $v }}</label>
                        @endforeach
                    @endif
                </small></p>
                    </div>
                  </div>
            </div>
            <div class="col-md-8">
                <form class="border px-4 pt-2 pb-3" method="POST" action="{{route('profile-update',$profile->id)}}"  enctype ="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="inputTitle" class="col-form-label">العميل</label>
                      <input id="inputTitle" type="text" name="name" placeholder="العميل  "  value="{{$profile->name}}" class="form-control">
                      @error('name')
                      <span class="text-danger">{{$message}}</span>
                      @enderror
                      </div>
              
                      <div class="form-group">
                          <label for="inputEmail" class="col-form-label">ایمیل</label>
                        <input id="inputEmail" disabled type="email" name="email" placeholder="ایمیل  "  value="{{$profile->email}}" class="form-control">
                        @error('email')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>
              
                      <div class="form-group">
                      <label for="inputPhoto" class="col-form-label">صورة</label>
                      <div class="input-group">
                          <span class="input-group-btn">
                              {{-- <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                              <i class="fa fa-picture-o"></i> اختيار
                              </a> --}}
                              <input type="file" id="images" class="form-control" name="pic" />

                          </span>
                          <input id="thumbnail" class="form-control" type="text" name="photo" value="{{$profile->photo}}">
                      </div>
                        @error('photo')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>
                      <div class="form-group">
                          <label for="role" class="col-form-label">الدور</label>
                          {{-- <select name="role" class="form-control">
                              <option value="">-----اختيار الدور-----</option>
                                  <option value="admin" {{(($profile->role=='admin')? 'selected' : '')}}>مدیر</option>
                                  <option value="user" {{(($profile->role=='user')? 'selected' : '')}}>مستخدم</option>
                          </select> --}}
                          {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control','multiple'))
                          !!}
                          @error('role')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                        </div>

                        <button type="submit" class="btn btn-success btn-sm">ارسال</button>
                </form>
            </div>
        </div>
   </div>
</div>

@endsection

<style>
    .breadcrumbs{
        list-style: none;
    }
    .breadcrumbs li{
        float:left;
        margin-right:10px;
    }
    .breadcrumbs li a:hover{
        text-decoration: none;
    }
    .breadcrumbs li .active{
        color:red;
    }
    .breadcrumbs li+li:before{
      content:"/\00a0";
    }
    .image{
        background:url('{{asset('backend/img/background.jpg')}}');
        height:150px;
        background-position:center;
        background-attachment:cover;
        position: relative;
    }
    .image img{
        position: absolute;
        top:55%;
        left:35%;
        margin-top:30%;
    }
    i{
        font-size: 14px;
        padding-right:8px;
    }
  </style> 

@push('scripts')
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script>
    $('#lfm').filemanager('image');
</script>
@endpush