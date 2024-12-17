@extends('backend.layouts.master')

@section('main-content')

<div class="card">
    <h5 class="card-header">اضافة</h5>
    <div class="card-body">
      <form method="post" action="{{route('users.store')}}"  enctype ="multipart/form-data">
        {{csrf_field()}}
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">العميل</label>
        <input id="inputTitle" type="text" name="name" placeholder="العميل  "  value="{{old('name')}}" class="form-control">
        @error('name')
        <span class="text-danger">{{$message}}</span>
        @enderror
        </div>

        <div class="form-group">
            <label for="inputEmail" class="col-form-label">ایمیل</label>
          <input id="inputEmail" type="email" name="email" placeholder="ایمیل  "  value="{{old('email')}}" class="form-control">
          @error('email')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
            <label for="inputPassword" class="col-form-label">كلمة السر</label>
          <input id="inputPassword" type="password" name="password" placeholder="كلمة المرور"  value="{{old('password')}}" class="form-control">
          @error('password')
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
                <input type="file"   class="btn btn-primary" name="pic" />

            </span>
            
            <input id="thumbnail" class="form-control" type="text" name="photo" value="{{old('photo')}}">
        </div>
        <img id="holder" style="margin-top:15px;max-height:100px;">
          @error('photo')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        @php 
        // $roles=DB::table('users')->select('roles_name')->get();
         @endphp
        <div class="form-group">
            <label for="role" class="col-form-label">الدور</label>
            {{-- <select name="role" class="form-control">
                <option value="">-----اختيار الدور-----</option>
                @foreach($roles as $role)
                    <option value="{{$role->role}}">{{$role->role}}</option>
                @endforeach
            </select> --}}
            {!! Form::select('roles_name[]', $roles,[], array('class' => 'form-control','multiple')) !!}

          @error('role')
          <span class="text-danger">{{$message}}</span>
          @enderror
          </div>
          <div class="row row-sm mg-b-20">
            <div class="col-lg-6">
                <label class="form-label">المتجر التابع لها </label>
                
                    
               
                <select name="branch_id" id="select-beast" class="form-control  nice-select  custom-select">
                    @foreach ($vendors as $g)
                    <option value="{{$g->id}}">{{$g->branch_name}}</option>
                    @endforeach
                </select>

                
            </div>
        </div>
          <div class="form-group">
            <label for="status" class="col-form-label">الحالة</label>
            <select name="status" class="form-control">
                <option value="active">فعال</option>
                <option value="inactive">غیرفعال</option>
            </select>
          @error('status')
          <span class="text-danger">{{$message}}</span>
          @enderror
          </div>
        <div class="form-group mb-3">
          <button type="reset" class="btn btn-warning">مسح</button>
           <button class="btn btn-success" type="submit">ارسال</button>
        </div>
      </form>
    </div>
</div>

@endsection

@push('scripts')
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script>
    $('#lfm').filemanager('image');
</script>
@endpush