<!-- Back-to-top -->
<a href="#top" id="back-to-top"><i class="las la-angle-double-up"></i></a>
<!-- JQuery min js -->
{{-- <script src="http://10.12.13.70/exams/voice-files/assets/plugins/jquery/jquery.min.js"></script> --}}

 <script src="{{URL::asset('assets/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap Bundle js -->
{{-- <script src="http://10.12.13.70/exams/voice-files/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script> --}}

<script src="{{URL::asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- Ionicons js -->
{{-- <script src="http://10.12.13.70/exams/voice-files/assets/plugins/ionicons/ionicons.js"></script> --}}

<script src="{{URL::asset('assets/plugins/ionicons/ionicons.js')}}"></script>
<!-- Moment js -->
{{-- <script src="http://10.12.13.70/exams/voice-files/assets/plugins/moment/moment.js"></script> --}}

<script src="{{URL::asset('assets/plugins/moment/moment.js')}}"></script>
			<!--          data pagination timer       -->
{{-- <script src="http://10.12.13.70/exams/voice-files/js/simplyCountdown.min.js"></script>
				
<script src="{{URL::asset('js/paginga.jquery.js')}}"></script>
<script src="http://10.12.13.70/exams/voice-files/js/simplyCountdown.min.js"></script>
			 --}}
            {{-- <script src="{{URL::asset('js/simplyCountdown.min.js')}}"></script> --}}
            {{-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> --}}







            <!--          data pagination timer       -->

<!-- Rating js-->
{{-- <script src="{{URL::asset('assets/plugins/rating/jquery.rating-stars.js')}}"></script>
<script src="{{URL::asset('assets/plugins/rating/jquery.barrating.js')}}"></script> --}}

<!--Internal  Perfect-scrollbar js -->
{{-- <script src="http://10.12.13.70/exams/voice-files/assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script> --}}
<script src="{{URL::asset('assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>

{{-- <script src="http://10.12.13.70/exams/voice-files/assets/plugins/perfect-scrollbar/p-scroll.js"></script> --}}
<!--Internal Sparkline js -->
<script src="{{URL::asset('assets/plugins/perfect-scrollbar/p-scroll.js')}}"></script>

{{-- <script src="http://10.12.13.70/exams/voice-files/assets/plugins/jquery-sparkline/jquery.sparkline.min.js"></script> --}}
<!-- Custom Scroll bar Js-->
<script src="{{URL::asset('assets/plugins/jquery-sparkline/jquery.sparkline.min.js')}}"></script>

{{-- <script src="http://10.12.13.70/exams/voice-files/assets/plugins/mscrollbar/jquery.mCustomScrollbar.concat.min.js"></script> --}}
<!-- right-sidebar js -->
<script src="{{URL::asset('assets/plugins/mscrollbar/jquery.mCustomScrollbar.concat.min.js')}}"></script>

{{-- <script src="http://10.12.13.70/exams/voice-files/assets/plugins/sidebar/sidebar-rtl.js"></script>
<script src="http://10.12.13.70/exams/voice-files/assets/plugins/sidebar/sidebar-custom.js"></script> --}}

<script src="{{URL::asset('assets/plugins/sidebar/sidebar-rtl.js')}}"></script>

<script src="{{URL::asset('assets/plugins/sidebar/sidebar-custom.js')}}"></script>

<!-- Eva-icons js -->

{{-- <script src="http://10.12.13.70/exams/voice-files/assets/js/eva-icons.min.js"></script> --}}
<script src="{{URL::asset('assets/js/eva-icons.min.js')}}"></script>

@yield('js')
<!-- Sticky js -->

{{-- <script src="http://10.12.13.70/exams/voice-files/assets/js/sticky.js"></script> --}}
<script src="{{URL::asset('assets/js/sticky.js')}}"></script>

<!-- custom js -->
{{-- 
<script src="http://10.12.13.70/exams/voice-files/assets/js/custom.js"></script><!-- Left-menu js-->
<script src="http://10.12.13.70/exams/voice-files/assets/plugins/side-menu/sidemenu.js"></script> --}}

<script src="{{URL::asset('assets/js/custom.js')}}"></script>
<script src="{{URL::asset('assets/plugins/side-menu/sidemenu.js')}}"></script>

<script>
    $(document).ready(function() {
 
        if ($('#choice2').prop('checked')) {
                $('.app-sidebar').css('background-color', 'aliceblue');
                // Remove existing list item with the text "تحريري"
                $('.side-menu li:contains("تحريري")').remove();

                // Create a new list item element
                var newItem = $('<li class="side-item side-item-category">').text('شفوي');

                // Add the new item at the top of the side-menu
                $('.side-menu').prepend(newItem);
            } else if($('#choice1').prop('checked')){
                $('.app-sidebar').css('background-color', 'lightgoldenrodyellow');
                // Remove existing list item with the text "شفوي"
                $('.side-menu li:contains("شفوي")').remove();

                // Create a new list item element
                var newItem = $('<li class="side-item side-item-category">').text('تحريري');

                // Add the new item at the top of the side-menu
                $('.side-menu').prepend(newItem);
            }
    
        $('input[name="choice"]').change(function() {
            var selectedChoice = $(this).val();
 
             
            // Send AJAX request to change session
            $.ajax({
                url :'{{ route("changes.type") }}',
                method: 'POST',
                data: { choice: selectedChoice,
                    _token: '{{ csrf_token() }}'

                },
                success: function(response) {
                    // Handle success response
                    console.log(response);
                       // $('.app-sidebar').removeClass('app-sidebar').addClass('new-sidebar');
                     if(response['choice']==1){
                        $('.app-sidebar').css('background-color', 'aliceblue');
                        // Create a new list item element
                        $('.side-menu li:contains("تحريري")').remove();

                        var newItem = $('<li class="side-item side-item-category">').text('شفوي');

                        // Add the new item at the top of the side-menu
                        $('.side-menu').prepend(newItem);

                    }else{
                        $('.app-sidebar').css('background-color', 'lightgoldenrodyellow');
                        // Create a new list item element
                        $('.side-menu li:contains("شفوي")').remove();

                        var newItem = $('<li class="side-item side-item-category">').text('تحريري');

                        // Add the new item at the top of the side-menu
                        $('.side-menu').prepend(newItem);

                    }
                    window.location.href = "{{ route('home') }}";

                },
                error: function(xhr, status, error) {
                    // Handle error response
                    console.log(xhr.responseText);
                }
            });
        });
    });
</script>
