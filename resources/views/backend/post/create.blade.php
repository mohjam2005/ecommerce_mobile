@extends('backend.layouts.master')

@section('main-content')

<div class="card">
    <h5 class="card-header">اضافة  الموضوع</h5>
    <div class="card-body">
      <form method="post" action="{{route('post.store')}}" enctype ="multipart/form-data">
        {{csrf_field()}}
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">عنوان <span class="text-danger">*</span></label>
          <input id="inputTitle" type="text" name="title" placeholder="عنوان  "  value="{{old('title')}}" class="form-control">
          @error('title')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="quote" class="col-form-label">نقل قول</label>
          <textarea class="form-control" id="quote" name="quote">{{old('quote')}}</textarea>
          @error('quote')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="summary" class="col-form-label">خلاصه <span class="text-danger">*</span></label>
          <textarea class="form-control" id="summary" name="summary">{{old('summary')}}</textarea>
          @error('summary')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="description" class="col-form-label">الوصف</label>
          <textarea class="form-control" id="description" name="description">{{old('description')}}</textarea>
          @error('description')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="post_cat_id">القسم الرئيسي  <span class="text-danger">*</span></label>
          <select name="post_cat_id" class="form-control">
              <option value="">--اختيار القسم الرئيسي --</option>
              @foreach($categories as $key=>$data)
                  <option value='{{$data->id}}'>{{$data->title}}</option>
              @endforeach
          </select>
        </div>

        <div class="form-group">
          <label for="tags">التاغ</label>
          <select name="tags[]" multiple  data-live-search="true" class="form-control selectpicker">
              <option value="">--اختيار التاغ--</option>
              @foreach($tags as $key=>$data)
                  <option value='{{$data->title}}'>{{$data->title}}</option>
              @endforeach
          </select>
        </div>
        <div class="form-group">
          <label for="added_by">المؤلف</label>
          <select name="added_by" class="form-control">
              <option value="">--اختيار المؤلف--</option>
              @foreach($users as $key=>$data)
                <option value='{{$data->id}}' {{($key==0) ? 'selected' : ''}}>{{$data->name}}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group">
          <label for="inputPhoto" class="col-form-label">صورة <span class="text-danger">*</span></label>
          <div class="input-group">
              <span class="input-group-btn">
                  {{-- <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                  <i class="fa fa-picture-o"></i> اختيار
                  </a> --}}
                  <input type="file" id="images" class="form-control" name="pic" />

                </span>
          <input id="thumbnail" class="form-control" type="text" name="photo" value="{{old('photo')}}">
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
@endpush
@push('scripts')
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script src="{{asset('backend/summernote/summernote.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

<script>
    $('#lfm').filemanager('image');

    $(document).ready(function() {
      $('#summary').summernote({
        placeholder: "الوصف کوتاه بنویسید.....",
          tabsize: 2,
          height: 100
      });
    });

    $(document).ready(function() {
      $('#description').summernote({
        placeholder: "الوصف کامل بنویسید.....",
          tabsize: 2,
          height: 150
      });
    });

    $(document).ready(function() {
      $('#quote').summernote({
        placeholder: "نقل قول کامل بنویسید.....",
          tabsize: 2,
          height: 100
      });
    });
    // $('select').selectpicker();

</script>
@endpush