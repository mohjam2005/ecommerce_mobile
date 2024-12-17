@extends('frontend.theme2.layouts.master')
@section('title','تک اسپورت || الدفع موفق ')

@section('title','Order Success')
@section('main-content')
<main class="order-success-page default space-top-30">
	<div class="container">
		<div class="row">
			<div class="col-12 text-center">
				<h1>الطلب شما با موفقیت ثبت شد</h1>
				<p>از خرید شما متشکریم. الطلب شما جاري المعالجة است.</p>
				<p> رقم الطلب شما: <strong>{{ $order->order_number }}</strong></p>
				<p>الاجمالي: <strong>{{ number_format($order->total_amount, 2) }} $</strong></p>
				<a href="{{ route('home') }}" class="btn btn-main-masai">بازگشت به صفحه اصلی</a>
			</div>
		</div>
	</div>
</main>
@endsection