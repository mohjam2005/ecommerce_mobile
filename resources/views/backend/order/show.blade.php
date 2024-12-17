@extends('backend.layouts.master')

@section('title','جزئیات الطلب')

@section('main-content')
<div class="card">
<h5 class="card-header">الطلب       <a href="{{route('order.pdf',$order->id)}}" class=" btn btn-sm btn-primary shadow-sm float-right"><i class="fas fa-download fa-sm text-white-50"></i> تولید PDF</a>
  </h5>
  <div class="card-body">
    @if($order)
    <table class="table table-striped table-hover">
      <thead>
        <tr>
            <th>الرقم</th>
            <th> رقم الطلب</th>
            <th>العميل</th>
            <th>ایمیل</th>
            <th>العدد</th>
            <th>الكمية</th>
            <th>الاجمالي</th>
            <th>الحالة</th>
            <th>عملیات</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>{{$order->id}}</td>
<td>{{$order->order_number}}</td>
<td>{{$order->first_name}} {{$order->last_name}}</td>
<td>{{$order->email}}</td>
<td>{{$order->quantity}}</td>
<td>T{{$order->shipping->price}}</td>
<td>T{{number_format($order->total_amount,2)}}</td>
<td>
    @if($order->status=='new')
      <span class="badge badge-primary">{{$order->status}}</span>
    @elseif($order->status=='process')
      <span class="badge badge-warning">{{$order->status}}</span>
    @elseif($order->status=='delivered')
      <span class="badge badge-success">{{$order->status}}</span>
    @else
      <span class="badge badge-danger">{{$order->status}}</span>
    @endif
</td>
<td>
    <a href="{{route('order.edit',$order->id)}}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="تعديل" data-placement="bottom"><i class="fas fa-edit"></i></a>
    <form method="POST" action="{{route('order.destroy',[$order->id])}}">
      @csrf
      @method('delete')
          <button class="btn btn-danger btn-sm dltBtn" data-id={{$order->id}} style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="حذف"><i class="fas fa-trash-alt"></i></button>
    </form>
</td>

        </tr>
      </tbody>
    </table>

    <section class="confirmation_part section_padding">
      <div class="order_boxes">
        <div class="row">
          <div class="col-lg-6 col-lx-4">
            <div class="order-info">
              <h4 class="text-center pb-4">اطلاعات الطلب</h4>
              <table class="table">
                    <tr class="">
                      <td>   {{$order->order_number}}</td>
                        <td> رقم الطلب </td>
                    </tr>
                    <tr>
                        <td>  {{$order->created_at->format('D d M, Y')}} در {{$order->created_at->format('g : i a')}} </td>

                        <td>تاریخ الطلب </td>

                    </tr>
                    <tr>
                        <td>  {{$order->quantity}}</td>

                        <td>العدد  </td>

                    </tr>
                    <tr>
                        <td>  {{$order->status}}</td>

                        <td>حالة الطلب </td>

                    </tr>
                    <tr>
                        <td>  $ {{$order->shipping->price}}</td>

                        <td> ثمن النقل  </td>

                    </tr>
                    <tr>
                      <td>  $ {{number_format($order->coupon,2)}}</td>
                      <td>كوبون   </td>

                    </tr>
                    <tr>
                        <td>  $ {{number_format($order->total_amount,2)}}</td>
                        <td>الاجمالي </td>

                    </tr>
                    <tr>
                        <td>  @if($order->payment_method=='cod') الدفع بالمحل @else باي بال @endif</td>
                        <td>طريقة الدفع </td>

                      </tr>
                    <tr>
                        <td>  {{$order->payment_status}}</td>

                        <td>حالة  الدفع </td>

                    </tr>
              </table>
            </div>
          </div>

          <div class="col-lg-6 col-lx-4">
            <div class="shipping-info">
              <h4 class="text-center pb-4">بيانات العميل</h4>
              <table class="table">
                    <tr class="">
                       
                      <td>  {{$order->first_name}} {{$order->last_name}}</td>
                      <td> بيانات العميل</td>

                    </tr>
                    <tr>
                        <td> {{$order->email}}</td>
                        <td>ایمیل</td>

                    </tr>
                    <tr>
                        <td>  {{$order->phone}}</td>
                        <td>رقم الجوال</td>

                    </tr>
                    <tr>

                        <td>  {{$order->address1}}, {{$order->address2}}</td>
                        <td>العنوان</td>

                    </tr>
                    <tr>
                        <td>   {{$order->country}}</td>
                        <td>الدولة</td>

                    </tr>
                    <tr>
                        <td>  {{$order->post_code}}</td>
                        <td>كود الدولة</td>

                    </tr>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
    @endif

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