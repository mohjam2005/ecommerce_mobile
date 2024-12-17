@extends('backend.layouts.master')

@section('title','انشاء اعلان')

@section('main-content')

<div class="card">
    <h5 class="card-header">اضافة  بنر</h5>
    <div class="card-body">
      <form method="post" action="{{route('banner.store')}}" enctype ="multipart/form-data">
        {{csrf_field()}}
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">عنوان <span class="text-danger">*</span></label>
        <input id="inputTitle" type="text" name="title" placeholder="عنوان  "  value="{{old('title')}}" class="form-control">
        @error('title')
        <span class="text-danger">{{$message}}</span>
        @enderror
        </div>

        <div class="form-group">
          <label for="inputDesc" class="col-form-label">الوصف</label>
          <textarea class="form-control" id="description" name="description">{{old('description')}}</textarea>
          @error('description')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
        <label for="inputPhoto" class="col-form-label">صورة <span class="text-danger">*</span></label>
        <div class="input-group">
            <span class="input-group-btn">
              
                {{-- <a type="file" class="btn btn-primary">
                </a> --}}
                 <input type="file" id="images" class="form-control" name="pic" />
             </span>
          {{-- <input id="thumbnail" class="form-control" type="text" name="photo" value="{{old('photo')}}"> --}}
        </div>
        <div id="holder" style="margin-top:15px;max-height:100px;"></div>
          @error('photo')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        
        <div class="form-group">
          <label for="status" class="col-form-label">الحالة <span class="text-danger">*</span></label>
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

@push('styles')
<link rel="stylesheet" href="{{asset('backend/summernote/summernote.min.css')}}">
@endpush
@push('scripts')
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script src="{{asset('backend/summernote/summernote.min.js')}}"></script>
<script>
    $('#lfm').filemanager('image');

    $(document).ready(function() {
    $('#description').summernote({
      placeholder: "الوصف کوتاه بنویسید.....",
        tabsize: 2,
        height: 150
    });
    });
</script>
@endpush