@extends('backend.layouts.master')

@section('title','تعديل بررسی')

@section('main-content')
<div class="card">
  <h5 class="card-header">تعديل بررسی</h5>
  <div class="card-body">
    <form action="{{route('review.update',$review->id)}}" method="POST">
      @csrf
      @method('PATCH')
      <div class="form-group">
        <label for="name">بررسی توسط:</label>
        <input type="text" disabled class="form-control" value="{{$review->user_info->name}}">
      </div>
      <div class="form-group">
        <label for="review">بررسی</label>
      <textarea name="review" id="" cols="20" rows="10" class="form-control">{{$review->review}}</textarea>
      </div>
      <div class="form-group">
        <label for="status">الحالة :</label>
        <select name="status" id="" class="form-control">
          <option value="">--اختيار الحالة--</option>
          <option value="active" {{(($review->status=='active')? 'selected' : '')}}>فعال</option>
          <option value="inactive" {{(($review->status=='inactive')? 'selected' : '')}}>غیرفعال</option>
        </select>
      </div>
      <button type="submit" class="btn btn-primary">ارسال</button>
    </form>
  </div>
</div>
@endsection

@push('styles')
<style>
    .order-info,.shipping-info{
        background:#ECECEC;
        padding:20px;
    }
    .order-info h4,.shipping-info h4{
        text-decoration: underline;
    }
</style>
@endpush