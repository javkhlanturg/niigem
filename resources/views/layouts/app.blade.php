<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Мэдээ, Мэдээллийн Үндэсний портал</title>
    <!-- google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i|Ubuntu:300,300i,400,400i,500,500i,700,700i" rel="stylesheet">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <!-- Scrollbar css -->
    <link rel="stylesheet" type="text/css" href="/assets/css/jquery.mCustomScrollbar.css">
    <!-- Owl Carousel css -->
    <link rel="stylesheet" type="text/css" href="/assets/owl-carousel/owl.carousel.css">
    <link rel="stylesheet" type="text/css" href="/assets/owl-carousel/owl.theme.css">
    <link rel="stylesheet" type="text/css" href="/assets/owl-carousel/owl.transitions.css">
    <!-- youtube css -->
    <link rel="stylesheet" type="text/css" href="/assets/css/RYPP.css">
    <!-- jquery-ui css -->
    <link rel="stylesheet" href="/assets/css/jquery-ui.css">
    <!-- animate -->
    <link rel="stylesheet" href="/assets/css/animate.min.css">
    <!-- fonts css -->
    <link rel="stylesheet" href="/assets/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/Pe-icon-7-stroke.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/flaticon.css">
    <!-- custom css -->
    <link rel="stylesheet" href="/assets/css/style.css">
    <style>
    .dropdown:hover{display: block;}
    </style>
    @yield('css')
</head>

<body>
    <?php $menus = \TCG\Voyager\Models\Menu::where('name', "site_menu")->first()->items->sortBy('order'); ?>
    <?php $banner_top = App\Banners::where('banner_position', 'top_banner')->first(); ?>
    <?php $logo = App\Banners::where('id', 3)->first(); ?>
    @include('frontend.header', ['menus'=>$menus,'top_banner'=>$banner_top, 'logo'=>$logo])
    @yield('content')
    @include('frontend.footer', ['logo'=>$logo])

    <script type="text/javascript" src="/assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="/assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/assets/js/metisMenu.min.js"></script>
    <script type="text/javascript" src="/assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script type="text/javascript" src="/assets/js/wow.min.js"></script>
    <script type="text/javascript" src="/assets/js/jquery.newsTicker.js"></script>
    <script type="text/javascript" src="/assets/js/classie.js"></script>
    <script type="text/javascript" src="/assets/owl-carousel/owl.carousel.js"></script>
    <script type="text/javascript" src="/assets/js/RYPP.js"></script>
    <script type="text/javascript" src="/assets/js/jquery-ui.js"></script>
    <script type="text/javascript" src="/assets/js/form-classie.js"></script>
    <script type="text/javascript" src="/assets/js/custom.js"></script>
    @yield('javascript')
    <script>
    $(document).ready(function(){
      $('.dropdown').mouseenter(function(){
        if(!$('.navbar-toggle').is(':visible')) { // disable for mobile view
            if(!$(this).hasClass('open')) { // Keeps it open when hover it again
                $('.dropdown-toggle', this).trigger('click');
            }
        }
    });
    $('li.dropdown').on('click', function() {
      var $el = $(this);
      if ($el.hasClass('open')) {
          var $a = $el.children('a.dropdown-toggle');
          if ($a.length && $a.attr('href')) {
              location.href = $a.attr('href');
          }
      }
    });

    $.post("/action/home",{ action:'weather', _token:"{{ csrf_token() }}" }, function(data){
         $('#weathers').html(data.html);
    });

    $.post("/action/home",{ action:'actionews', _token:"{{ csrf_token() }}" }, function(data){
         $('#topnews').html(data.topnews);
         $('#mostviewed').html(data.mostviewed);
    });
  });
    </script>
</body>

</html>
