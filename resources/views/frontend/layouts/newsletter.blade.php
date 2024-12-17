<!-- شروع خبرالعميله فروشگاه -->
<section class="shop-newsletter section">
    <div class="container">
        <div class="inner-top">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 col-12">
                    <!-- شروع خبرالعميله داخلی -->
                    <div class="inner">
                        <h4>خبرالعميله</h4>
                        <p>عضویت در خبرالعميله ما و دریافت <span>۱۰٪</span> نسبة التخفيض در اولین خرید</p>
                        <form action="{{route('subscribe')}}" method="post" class="newsletter-inner">
                            @csrf
                            <input name="email" placeholder="العنوان ایمیل شما" required="" type="email">
                            <button class="btn" type="submit">عضویت</button>
                        </form>
                    </div>
                    <!-- پایان خبرالعميله داخلی -->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- پایان خبرالعميله فروشگاه -->