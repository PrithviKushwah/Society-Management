<!--
=========================================================
* Material Dashboard 2 - v3.0.0
=========================================================

* Product Page: https://www.creative-tim.com/product/material-dashboard
* Copyright 2021 Creative Tim (https://www.creative-tim.com) & UPDIVISION (https://www.updivision.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by www.creative-tim.com & www.updivision.com

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang='en' dir="{{ Route::currentRouteName() == 'rtl' ? 'rtl' : '' }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets') }}/img/apple-icon.png">
    <link rel="icon" type="image/png" href="{{ asset('assets') }}/img/favicon.png">
    <title>
        
    </title>

    <!-- Metas -->
    @if (env('IS_DEMO'))
        <meta name="keywords" content="creative tim, updivision, material, html dashboard, laravel, livewire, laravel livewire, alpine.js, html css dashboard laravel, material dashboard laravel, livewire material dashboard, material admin, livewire dashboard, livewire admin, web dashboard, bootstrap 5 dashboard laravel, bootstrap 5, css3 dashboard, bootstrap 5 admin laravel, material dashboard bootstrap 5 laravel, frontend, responsive bootstrap 5 dashboard, material dashboard, material laravel bootstrap 5 dashboard" />
        <meta name="description" content="Dozens of handcrafted UI components, Laravel authentication, register & profile editing, Livewire & Alpine.js" />
        <meta itemprop="name" content="Material Dashboard 2 Laravel Livewire by Creative Tim & UPDIVISION" />
        <meta itemprop="description" content="Dozens of handcrafted UI components, Laravel authentication, register & profile editing, Livewire & Alpine.js" />
        <meta itemprop="image" content="https://s3.amazonaws.com/creativetim_bucket/products/600/original/material-dashboard-laravel-livewire.jpg" />
        <meta name="twitter:card" content="product" />
        <meta name="twitter:site" content="@creativetim" />
        <meta name="twitter:title" content="Material Dashboard 2 Laravel Livewire by Creative Tim & UPDIVISION" />
        <meta name="twitter:description" content="Dozens of handcrafted UI components, Laravel authentication, register & profile editing, Livewire & Alpine.js" />
        <meta name="twitter:creator" content="@creativetim" />
        <meta name="twitter:image" content="https://s3.amazonaws.com/creativetim_bucket/products/600/original/material-dashboard-laravel-livewire.jpg" />
        <meta property="fb:app_id" content="655968634437471" />
        <meta property="og:title" content="Material Dashboard 2 Laravel Livewire by Creative Tim & UPDIVISION" />
        <meta property="og:type" content="article" />
        <meta property="og:url" content="https://www.creative-tim.com/live/material-dashboard-laravel-livewire" />
        <meta property="og:image" content="https://s3.amazonaws.com/creativetim_bucket/products/600/original/material-dashboard-laravel-livewire.jpg" />
        <meta property="og:description" content="Dozens of handcrafted UI components, Laravel authentication, register & profile editing, Livewire & Alpine.js" />
        <meta property="og:site_name" content="Creative Tim" />
    @endif
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Nucleo Icons -->
    <link href="{{ asset('assets') }}/css/nucleo-icons.css" rel="stylesheet" />
    <link href="{{ asset('assets') }}/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('assets') }}/css/material-dashboard.css?v=3.0.0" rel="stylesheet" />
    <link id="pagestyle" href="{{ asset('css/custom.css') }}" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    
    @livewireStyles
</head>
<body class="g-sidenav-show {{ Route::currentRouteName() == 'rtl' ? 'rtl' : '' }} {{ Route::currentRouteName() == 'register' || Route::currentRouteName() == 'static-sign-up'  ? '' : 'bg-gray-200' }}">

{{ $slot }}

<script src="{{ asset('assets') }}/js/core/popper.min.js"></script>
<script src="{{ asset('assets') }}/js/core/bootstrap.min.js"></script>
<script src="{{ asset('assets') }}/js/plugins/perfect-scrollbar.min.js"></script>
<script src="{{ asset('assets') }}/js/plugins/smooth-scrollbar.min.js"></script>

@stack('js')
<script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }

</script>
<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc 11-->
<script src="{{ asset('assets') }}/js/material-dashboard.min.js?v=3.0.0"></script>
@livewireScripts
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script language="JavaScript">
window.onload = function(){

  $(function(){
//   $('#datepicker').datepicker();
});
};

//  script for quantity starts

$(document).on('click', '.qty-plus', function () {
   $(this).prev().val(+$(this).prev().val() + 1);
});
$(document).on('click', '.qty-minus', function () {
   if ($(this).next().val() > 0) $(this).next().val(+$(this).next().val() - 1);
});

//  script for quantity ends


class Countdown {
  constructor(el){
    this.el = el;
    this.targetDate = new Date(el.getAttribute("date-time"));
    this.createCountDownParts()
    this.countdownFunction();
    this.countdownLoopId = setInterval(this.countdownFunction.bind(this), 1000)
  }
  createCountDownParts(){
    ["d", "h", "m", "s"].forEach(part => {
      const partEl = document.createElement("div");
      partEl.classList.add("part", part);
      const textEl = document.createElement("div");
      textEl.classList.add("text");
      textEl.innerText = part;
      const numberEl = document.createElement("div");
      numberEl.classList.add("number");
      numberEl.innerText = 0;
      partEl.append(numberEl, textEl);
      this.el.append(partEl);
      this[part] = numberEl;
    })
  }

  countdownFunction(){
    const currentDate = new Date();    
    if(currentDate > this.targetDate) return clearInterval(this.intervalId);
    const remaining = this.getRemaining(this.targetDate, currentDate);
    Object.entries(remaining).forEach(([part,value]) => {
      this[part].style.setProperty("--value", value)
      this[part].innerText = value
    })  
  }
  
  getRemaining(target, now){
    let s = Math.floor((target - (now))/1000);
    let m = Math.floor(s/60);
    let h = Math.floor(m/60);
    let d = Math.floor(h/24);
    h = h-(d*24);
    m = m-(d*24*60)-(h*60);
    s = s-(d*24*60*60)-(h*60*60)-(m*60);
    return { d, h, m, s }      
  }

}

const countdownEls= document.querySelectorAll(".countdown") || [];
countdownEls.forEach(countdownEl => new Countdown(countdownEl))


// Search header 

$(document).ready(function() {
     
     $(".fa-search").click(function() {
        $(".search-box").toggle();
        $("input[type='text']").focus();
      });

  });



</script>

</body>
</html>
