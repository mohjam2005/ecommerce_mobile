@extends('backend.layouts.master')

@section('main-content')

<div class="card">
    <h5 class="card-header">تعديل مستخدم</h5>
    <div class="card-body">
      <form method="post" action="{{route('users.update',$user->id)}}"  enctype ="multipart/form-data">
        @csrf 
        @method('PATCH')
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">العميل</label>
        <input id="inputTitle" type="text" name="name" placeholder="العميل  "  value="{{$user->name}}" class="form-control">
        @error('name')
        <span class="text-danger">{{$message}}</span>
        @enderror
        </div>

        <div class="form-group">
            <label for="inputEmail" class="col-form-label">ایمیل</label>
          <input id="inputEmail" type="email" name="email" placeholder="ایمیل  "  value="{{$user->email}}" class="form-control">
          @error('email')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        {{-- <div class="form-group">
            <label for="inputPassword" class="col-form-label">رمز عبور</label>
          <input id="inputPassword" type="password" name="password" placeholder="رمز عبور  "  value="{{$user->password}}" class="form-control">
          @error('password')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div> --}}

        <div class="form-group">
        <label for="inputPhoto" class="col-form-label">صورة</label>
        <div class="input-group">
            <span class="input-group-btn">
                {{-- <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                <i class="fa fa-picture-o"></i> اختيار
                </a> --}}
                <input type="file" id="images" class="form-control" name="pic" />

            </span>
            <input id="thumbnail" class="form-control" type="text" name="photo" value="{{$user->photo}}">
        </div>
        <img id="holder" style="margin-top:15px;max-height:100px;">
          @error('photo')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        @php 
        // $roles=DB::table('users')->select('role')->where('id',$user->id)->get();
        // dd($roles);
        @endphp
        <div class="form-group">
            <label for="role" class="col-form-label">الدور</label>
            {{-- <select name="role" class="form-control">
                <option value="">-----اختيار الدور-----</option>
                @foreach($roles as $role)
                    <option value="{{$role->role}}" {{(($role->role=='admin') ? 'selected' : '')}}>مدیر</option>
                    <option value="{{$role->role}}" {{(($role->role=='user') ? 'selected' : '')}}>مستخدم</option>
                @endforeach
            </select> --}}
            {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control','multiple'))
            !!}
          @error('role')
          <span class="text-danger">{{$message}}</span>
          @enderror
          </div>
          <div class="form-group">
            <label for="status" class="col-form-label">الحالة</label>
            <select name="status" class="form-control">
                <option value="active" {{(($user->status=='active') ? 'selected' : '')}}>فعال</option>
                <option value="inactive" {{(($user->status=='inactive') ? 'selected' : '')}}>غیرفعال</option>
            </select>
          @error('status')
          <span class="text-danger">{{$message}}</span>
          @enderror
          </div>
          <div class="row row-sm mg-b-20">
            <div class="col-lg-6">
                <label class="form-label">المتجر التابع لها </label>
                
                    
        
                <select name="branch_id" id="select-beast" class="form-control  nice-select  custom-select">
                    {{-- <option value="{{ $user->goverment->id}}">{{ $user->goverment->branch_name}}</option> --}}
                    @foreach ($vendors as $g)
                    <option {{ $user->goverment->id == $g->id ? 'selected':'' }} value="{{$g->id}}" >{{$g->branch_name}}</option>
                    @endforeach
                </select>

                
            </div>
        </div>
        <div class="form-group mb-3">
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