<header>
    <!-- Mobile Menu Start -->
    <div class="mobile-menu-area navbar-fixed-top hidden-sm hidden-md hidden-lg">
        <nav class="mobile-menu" id="mobile-menu">
            <div class="sidebar-nav">
                <ul class="nav side-menu">
                    <li class="sidebar-search">
                        <div class="input-group custom-search-form">
                            <input type="text" class="form-control" placeholder="Search...">
                            <span class="input-group-btn">
                                    <button class="btn mobile-menu-btn" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                        </div>
                        <!-- /input-group -->
                    </li>
                    {!!Menu::display('site_menu', 'mobile_menu')!!}
                </ul>
            </div>
        </nav>
        <div class="container">
            <div class="top_header_icon">


            @if(Voyager::setting('twitter'))
                <span class="top_header_icon_wrap">
                      <a target="_blank" href="{{Voyager::setting('twitter')}}" title="Twitter"><i class="fa fa-twitter"></i></a>
                </span>
            @endif

            @if(Voyager::setting('facebook'))
                <span class="top_header_icon_wrap">
                      <a target="_blank" href="{{Voyager::setting('facebook')}}" title="Facebook"><i class="fa fa-facebook"></i></a>
                </span>
            @endif

            @if(Voyager::setting('googleplus'))
                <span class="top_header_icon_wrap">
                      <a target="_blank" href="{{Voyager::setting('googleplus')}}" title="Google"><i class="fa fa-google-plus"></i></a>
                </span>
            @endif
            
            </div>
            <div id="showLeft" class="nav-icon">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    <!-- Mobile Menu End -->
    <!-- top header -->
    <!-- <div class="top_header hidden-xs">
        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-md-3">
                  <div class="top_header_icon pull-left">
                    @if(Voyager::setting('twitter'))
                      <span class="top_header_icon_wrap">
                              <a target="_blank" href="{{Voyager::setting('twitter')}}" title="Twitter"><i class="fa fa-twitter"></i></a>
                          </span>
                    @endif
                    @if(Voyager::setting('facebook'))
                      <span class="top_header_icon_wrap">
                              <a target="_blank" href="{{Voyager::setting('facebook')}}" title="Facebook"><i class="fa fa-facebook"></i></a>
                          </span>
                    @endif
                    @if(Voyager::setting('googleplus'))
                      <span class="top_header_icon_wrap">
                              <a target="_blank" href="{{Voyager::setting('googleplus')}}" title="Google"><i class="fa fa-google-plus"></i></a>
                          </span>
                    @endif
                  </div>
                </div>

                <div class="col-sm-8 col-md-9">
                    <div class="newsticker-inner" style="padding-right:0px">


                        <ul id="weathers" style="float:right;margin-right:30px">
                            <li><i class="fa fa-spinner fa-spin"></i></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <div class="top_banner_wrap">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-4 col-sm-4">
                    <div class="header-logo">
                        <!-- logo -->
                        <a href="/">
                            <img class="td-retina-data img-responsive" src="{{$logo->bannerpath}}" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-xs-8 col-md-8 col-sm-8 hidden-xs">
                    <div class="header-banner">
                        <a href="{{$top_banner->url}}"><img class="td-retina img-responsive" src="{{$top_banner->bannerpath}}" alt=""></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- navber -->
    <div class="container hidden-xs">
        <nav class="navbar">
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                  {!!Menu::display('site_menu', 'site_menu')!!}
                </ul>
            </div>
            <!-- navbar-collapse -->
        </nav>
    </div>
</header>
