@extends('backend.layouts.master')

@section('main-content')

<div class="card">
    <h5 class="card-header">تعديل محصول</h5>
    <div class="card-body">
      <form method="post" action="{{route('product.update',$product->id)}}" enctype ="multipart/form-data">
        @csrf 
        @method('PATCH')
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">عنوان <span class="text-danger">*</span></label>
          <input id="inputTitle" type="text" name="title" placeholder="عنوان  "  value="{{$product->title}}" class="form-control">
          @error('title')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="summary" class="col-form-label">خلاصه <span class="text-danger">*</span></label>
          <textarea class="form-control" id="summary" name="summary">{{$product->summary}}</textarea>
          @error('summary')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="description" class="col-form-label">الوصف</label>
          <textarea class="form-control" id="description" name="description">{{$product->description}}</textarea>
          @error('description')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>


        <div class="form-group">
          <label for="is_featured">مميز</label><br>
          <input type="checkbox" name='is_featured' id='is_featured' value='{{$product->is_featured}}' {{(($product->is_featured) ? 'checked' : '')}}> لا                        
        </div>
              {{-- {{$categories}} --}}

        <div class="form-group">
          <label for="cat_id">القسم الرئيسي  <span class="text-danger">*</span></label>
          <select name="cat_id" id="cat_id" class="form-control">
              <option value="">--اختيار القسم الرئيسي --</option>
              @foreach($categories as $key=>$cat_data)
                  <option value='{{$cat_data->id}}' {{(($product->cat_id==$cat_data->id)? 'selected' : '')}}>{{$cat_data->title}}</option>
              @endforeach
          </select>
        </div>
        @php 
          $sub_cat_info=DB::table('categories')->select('title')->where('id',$product->child_cat_id)->get();
        // dd($sub_cat_info);

        @endphp
        {{-- {{$product->child_cat_id}} --}}
        <div class="form-group {{(($product->child_cat_id)? '' : 'd-none')}}" id="child_cat_div">
          <label for="child_cat_id">زیر القسم الرئيسي </label>
          <select name="child_cat_id" id="child_cat_id" class="form-control">
              <option value="">--اختيار زیر القسم الرئيسي --</option>
              
          </select>
        </div>

        <div class="form-group">
          <label for="price" class="col-form-label">القيمة (NRS) <span class="text-danger">*</span></label>
          <input id="price" type="number" name="price" placeholder="القيمة  "  value="{{$product->price}}" class="form-control">
          @error('price')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="discount" class="col-form-label">نسبة التخفيض (%)</label>
          <input id="discount" type="number" name="discount" min="0" max="100" placeholder="نسبة التخفيض"  value="{{$product->discount}}" class="form-control">
          @error('discount')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group">
          <label for="size">الحجم</label>
          <select name="size[]" class="form-control selectpicker"  multiple data-live-search="true">
              <option value="">--اختيار الحجم--</option>
              @foreach($items as $item)              
                @php 
                $data=explode(',',$item->size);
                // dd($data);
                @endphp
              <option value="S"  @if( in_array( "S",$data ) ) selected @endif>صغير</option>
              <option value="M"  @if( in_array( "M",$data ) ) selected @endif>متوسط</option>
              <option value="L"  @if( in_array( "L",$data ) ) selected @endif>كبير</option>
              <option value="XL"  @if( in_array( "XL",$data ) ) selected @endif>اكبر </option>
              @endforeach
          </select>
        </div>
        <div class="form-group">
          <label for="brand_id">البراند</label>
          <select name="brand_id" class="form-control">
              <option value="">--اختيار البراند--</option>
             @foreach($brands as $brand)
              <option value="{{$brand->id}}" {{(($product->brand_id==$brand->id)? 'selected':'')}}>{{$brand->title}}</option>
             @endforeach
          </select>
        </div>

        <div class="form-group">
          <label for="condition">الحالة</label>
          <select name="condition" class="form-control">
              <option value="">--اختيار الحالة--</option>
              <option value="default" {{(($product->condition=='default')? 'selected':'')}}>عادي</option>
              <option value="new" {{(($product->condition=='new')? 'selected':'')}}>جدید</option>
              <option value="hot" {{(($product->condition=='hot')? 'selected':'')}}>عليه طلب</option>
          </select>
        </div>

        <div class="form-group">
          <label for="stock">مقدار <span class="text-danger">*</span></label>
          <input id="quantity" type="number" name="stock" min="0" placeholder="المقدار"  value="{{$product->stock}}" class="form-control">
          @error('stock')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group">
          <label for="inputPhoto" class="col-form-label">صورة <span class="text-danger">*</span></label>
          <div class="input-group">
              <span class="input-group-btn">
                  {{-- <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary text-white">
                  <i class="fas fa-image"></i> اختيار
                  </a> --}}
                  <input type="file" id="images" class="form-control" name="pic" />


              </span>
          <input id="thumbnail" class="form-control" type="text" name="photo" value="{{$product->photo}}">
        </div>
        <div id="holder" style="margin-top:15px;max-height:100px;"></div>
          @error('photo')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <h3>صور المنتج</h3>
    
        <div class="form-group">
            @foreach ($product->product_images as $image)
         
            <div class="mb-3">
                <img src="{{ asset('storage/' . $image->image) }}" alt="Product Image" style="width: 150px; height: auto;">
                <label>
                    <input type="checkbox" name="delete_images[]" value="{{ $image->id }}"> حذف
                </label>
            </div>
            @endforeach
        </div>

        <div class="form-group">
            <label for="images">اضافة صور جديدة:</label>
            <input type="file" name="images[]" id="images" class="form-control" multiple>
        </div>

        <h3>المتغيرات</h3>
        <div id="variants">
            @foreach ($product->variants as $variant)
            <div class="variant">
                <label>اللون:</label>
                <input type="text" name="variants[{{ $variant->id }}][color]" value="{{ $variant->color }}">

                <label>الحجم:</label>
                <input type="text" name="variants[{{ $variant->id }}][size]" value="{{ $variant->size }}">

                <label>الثمن:</label>
                <input type="number" name="variants[{{ $variant->id }}][price]" value="{{ $variant->price }}">

                <label>المخزون:</label>
                <input type="number" name="variants[{{ $variant->id }}][stock]" value="{{ $variant->stock }}">
                {{-- <button type="button"  class="btn btn-warning" onclick="removeVariant(this)">حذف</button> --}}

            </div>
            @endforeach
        </div>
        <br>
        {{-- <button type="button" class="btn btn-success" onclick="addVariant()">اضافة متغير جديد</button>
        <br><br> --}}
        <div class="form-group">
          <label for="status" class="col-form-label">الحالة <span class="text-danger">*</span></label>
          <select name="status" class="form-control">
            <option value="active" {{(($product->status=='active')? 'selected' : '')}}>فعال</option>
            <option value="inactive" {{(($product->status=='inactive')? 'selected' : '')}}>غیرفعال</option>
        </select>
          @error('status')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group mb-3">
           <button class="btn btn-success" type="submit">ارسال</button>
        </div>
      </form>
    </div>
</div>

@endsection
<script>
  let variantIndex = 1;

  function addVariant() {
      const variantContainer = document.createElement('div');
      variantContainer.classList.add('variant');
      variantContainer.innerHTML = `
          <label>اللون:</label>
          <input type="text" name="variants[${variantIndex}][color]" required>

          <label>الحجم:</label>
          <input type="text" name="variants[${variantIndex}][size]" required>

          <label>الثمن ($):</label>
          <input type="number" name="variants[${variantIndex}][price]" step="0.01" required>

          <label>المخزون:</label>
          <input type="number" name="variants[${variantIndex}][stock]" required>

      `;
      document.getElementById('variants').appendChild(variantContainer);
      variantIndex++;
  }

  function removeVariant(button) {
      button.parentElement.remove();
  }
</script>
@push('styles')
<link rel="stylesheet" href="{{asset('backend/summernote/summernote.min.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
.variant {
  margin-bottom: 10px;
}
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
        height: 150
    });
    });
    $(document).ready(function() {
      $('#description').summernote({
        placeholder: "الوصف کامل بنویسید.....",
          tabsize: 2,
          height: 150
      });
    });
</script>

<script>
  var  child_cat_id='{{$product->child_cat_id}}';
        // alert(child_cat_id);
        $('#cat_id').change(function(){
            var cat_id=$(this).val();

            if(cat_id !=null){
                // تماس ایجکس
                $.ajax({
                    url:"/admin/category/"+cat_id+"/child",
                    type:"POST",
                    data:{
                        _token:"{{csrf_token()}}"
                    },
                    success:function(response){
                        if(typeof(response)!='object'){
                            response=$.parseJSON(response);
                        }
                        var html_option="<option value=''>--اختيار یکی--</option>";
                        if(response.status){
                            var data=response.data;
                            if(response.data){
                                $('#child_cat_div').removeClass('d-none');
                                $.each(data,function(id,title){
                                    html_option += "<option value='"+id+"' "+(child_cat_id==id ? 'selected ' : '')+">"+title+"</option>";
                                });
                            }
                            else{
                                console.log('هیچ داده‌ای پاسخ داده نشد');
                            }
                        }
                        else{
                            $('#child_cat_div').addClass('d-none');
                        }
                        $('#child_cat_id').html(html_option);

                    }
                });
            }
            else{

            }

        });
        if(child_cat_id!=null){
            $('#cat_id').change();
        }
</script>
@endpush