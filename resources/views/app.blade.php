<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>{{ config('app.name', 'Healthcare Portal') }}</title>
<script src="{{ asset('js/app.js') }}" defer></script>
<script src="{{ asset('js/myJs.js') }}" defer></script>
<script src="{{ asset('js/jquery-1.11.1.min.js') }}"></script>
<script src="{{ asset('js/vue-clazy-load.js') }}"></script>
<!-- Fonts -->
<!--mailbox-->
<!-- Styles -->
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<link href="{{ asset('css/mystyle.css') }}" rel="stylesheet">
<link href="{{ asset('css/all.css') }}" rel="stylesheet">
<link href="{{ asset('css/jquery.scrolling-tabs.min.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/fullpage.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/pannellum.css') }}"/>
<link rel="stylesheet" href="{{asset('css/nprogress.css')}}">
<script src="{{asset('js/nprogress.js')}}"></script>

<style>
    .bg-light {
        background-color: #eae9e9 !important;
    }
    #myBtn {
        display: none;
        position: fixed;
        bottom: 40px;
        right: 30px;
        z-index: 99;
        font-size: 18px;
        border: none;
        outline: none;
        background-color: #ff6117;
        color: transparent;
        cursor: pointer;
        padding: 15px;
        border-radius: 50%;
        background: url(../images/top-arrow.png) no-repeat left center;
    }

    #myBtn:hover {
        background: url(../images/top-arrow.png) no-repeat left center;
    }
    #panorama {
        width: 100%;
        height: 400px;
    }
    #homeBtn{
        display:none;
        position: fixed;
        top: 177px;
        left: -1px;
        z-index: 99;
        font-size: 14px;
        border: none;
        outline: none;
        background-color: #ff6117;
        color: #fff!important;
        cursor: pointer;
        border: 1px solid #e66527;
        border-radius: 30px !important;
        border-top-left-radius: 0px !important;
        border-bottom-left-radius: 0px !important;
        box-sizing: border-box;
        padding: 10px 20px;
        /* background: url(../images/home-24.png) no-repeat center; */
        /* box-shadow: 0 9px 10px -10px #d2571c; */
        box-shadow:0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
        text-decoration: none;
    }
    #homeBtn i.fa {
        color: white!important;
    }
    #homeBtn:hover {
        background: #fbaa84;
        border-color: #fbaa84;
    }
</style>
</head>
<body>
<div id="app">
  <index ></index>
</div>

<!-- <script src="/js/app.js" type="text/javascript"></script> -->
<!-- <script src="{{ asset('js/map-api.js') }}"></script> -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC-2U_IRuSrajQavHadFp8FlXNi61MA3nw&sensor=false"></script>
<script src="{{ asset('js/vue2-5-13.js') }}"></script>
<script src="{{ asset('js/vue-scrollto.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/pannellum.js') }}"></script>
<!-- Include after Vue (before closing body) -->
<script src="{{ asset('js/vue-fullpage.min.js') }}"></script>
<script src="{{ asset('js/sweetalert2.all.js') }}"></script>
<!-- script for editor -->
<script src="{{ asset('js/popper.min.js') }}"></script>
<!-- end script for editor -->
<script src="{{ asset('js/jquery.scrolling-tabs.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/custom.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/adsslider.js') }}" type="text/javascript"></script>

<script type="text/javascript">

 $(document).ready(function() {

     /*added for back to top*/
     var mybutton = document.getElementById("myBtn");
        // When the user scrolls down 20px from the top of the document, show the button
        window.onscroll = function() {scrollFunction()};
            function scrollFunction() {
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                mybutton.style.display = "block";
            } else {
                mybutton.style.display = "none";
            }
        }
        // When the user clicks on the button, scroll to the top of the document
        topFunction = function () {
            // document.body.scrollTop = 0;
            // document.documentElement.scrollTop = 0;
            $("html, body").animate({ scrollTop: 0 }, "slow");
	            return false;
        }

    if(localStorage.getItem("hospital_history")){
        $("#hos-his-local").html(localStorage.getItem("hospital_history").split(",").length);
        $('.his-hospital-link-box>a').css({'cursor':'pointer','pointer-events':'auto'});
    }
    else{
        $("#hos-his-local").html(0);
        $('.his-hospital-link-box>a').css({'cursor':'not-allowed','pointer-events':'none'});
        $( '.his-hospital-link-box>a ').parent('div').css({'cursor':'not-allowed'});
    }
    if(localStorage.getItem("nursing_history")){
        $("#nus-his-local").html(localStorage.getItem("nursing_history").split(",").length);
        $('.his-nursing-link-box>a').css({'cursor':'pointer','pointer-events':'auto'});
    }
    else{
        $("#nus-his-local").html(0);
        $('.his-nursing-link-box>a').css({'cursor':'not-allowed','pointer-events':'none'});
        $( '.his-nursing-link-box>a').parent('div').css({'cursor':'not-allowed'});
    }
    if(localStorage.getItem("hospital_fav")){
        $("#hos-fav-local").html(localStorage.getItem("hospital_fav").split(",").length);
        $('.fav-hospital-link-box>a').css({'cursor':'pointer','pointer-events':'auto'});
    }
    else{
        $("#hos-fav-local").html(0);
        $('.fav-hospital-link-box>a').css({'cursor':'not-allowed','pointer-events':'none'});
        $( '.fav-hospital-link-box>a').parent('div').css({'cursor':'not-allowed'});
    }
    if(localStorage.getItem("nursing_fav")){
        $("#nus-fav-local").html(localStorage.getItem("nursing_fav").split(",").length);
        $('.fav-nursing-link-box>a').css({'cursor':'pointer','pointer-events':'auto'});
    }
    else{
        $("#nus-fav-local").html(0);
        $('.fav-nursing-link-box>a').css({'cursor':'not-allowed','pointer-events':'none'});
        $( '.fav-nursing-link-box>a').parent('div').css({'cursor':'not-allowed'});
    }



});


</script>
</body>
</html>
