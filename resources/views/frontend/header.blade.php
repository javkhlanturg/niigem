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
                    @foreach($menus as $item)
                      <li><a href="{{$item->url}}">{{$item->title}}</a> </li>
                      @endforeach

                </ul>
            </div>
        </nav>
        <div class="container">
            <div class="top_header_icon">
                <span class="top_header_icon_wrap">
                        <a target="_blank" href="#" title="Twitter"><i class="fa fa-twitter"></i></a>
                    </span>
                <span class="top_header_icon_wrap">
                        <a target="_blank" href="#" title="Facebook"><i class="fa fa-facebook"></i></a>
                    </span>
                <span class="top_header_icon_wrap">
                        <a target="_blank" href="#" title="Google"><i class="fa fa-google-plus"></i></a>
                    </span>
                <span class="top_header_icon_wrap">
                        <a target="_blank" href="#" title="Vimeo"><i class="fa fa-vimeo"></i></a>
                    </span>
                <span class="top_header_icon_wrap">
                        <a target="_blank" href="#" title="Pintereset"><i class="fa fa-pinterest-p"></i></a>
                    </span>
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
    <div class="top_header hidden-xs">
        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-md-3">
                  <div class="top_header_icon">
                      <span class="top_header_icon_wrap">
                              <a target="_blank" href="#" title="Twitter"><i class="fa fa-twitter"></i></a>
                          </span>
                      <span class="top_header_icon_wrap">
                              <a target="_blank" href="#" title="Facebook"><i class="fa fa-facebook"></i></a>
                          </span>
                      <span class="top_header_icon_wrap">
                              <a target="_blank" href="#" title="Google"><i class="fa fa-google-plus"></i></a>
                          </span>
                      <span class="top_header_icon_wrap">
                              <a target="_blank" href="#" title="Vimeo"><i class="fa fa-vimeo"></i></a>
                          </span>
                      <span class="top_header_icon_wrap">
                              <a target="_blank" href="#" title="Pintereset"><i class="fa fa-pinterest-p"></i></a>
                          </span>
                  </div>
                </div>
                <!--breaking news-->
                <div class="col-sm-8 col-md-7">
                    <div class="newsticker-inner">
                      <?php /* ?>
                        <ul class="newsticker" style="float:right;">
                          <?php  $usd = Swap\Laravel\Facades\Swap::latest('USD/MNT');?>
                          <?php  $euro = Swap\Laravel\Facades\Swap::latest('EUR/MNT');?>
                          <?php  $gbp = Swap\Laravel\Facades\Swap::latest('GBP/MNT');?>
                          <?php  $jpy = Swap\Laravel\Facades\Swap::latest('JPY/MNT');?>
                          <?php  $krw = Swap\Laravel\Facades\Swap::latest('KRW/MNT');?>
                          <?php  $rub = Swap\Laravel\Facades\Swap::latest('RUB/MNT');?>
                          <?php  $cny = Swap\Laravel\Facades\Swap::latest('CNY/MNT');?>
                            <li><span class="color-1"><img src="/../assets/flag/usd.png" style="width: 16px;"/> USD:</span><a href="#"><?php echo number_format($usd->getValue()); ?></a></li>
                            <li><span class="color-1"><img src="/../assets/flag/eur.png" style="width: 16px;"/> UER:</span><a href="#"><?php echo number_format($euro->getValue()); ?></a></li>
                            <li><span class="color-1"><img src="/../assets/flag/cny.png" style="width: 16px;"/> CNY:</span><a href="#"><?php echo number_format($cny->getValue()); ?></a></li>
                            <li><span class="color-1"><img src="/../assets/flag/gbp.png" style="width: 16px;"/> GBP:</span><a href="#"><?php echo number_format($gbp->getValue()); ?></a></li>
                              <li><span class="color-1"><img src="/../assets/flag/JPE.png" style="width: 16px;"/> JPE:</span><a href="#"><?php echo number_format($jpy->getValue()); ?></a></li>
                            <li><span class="color-1"><img src="/../assets/flag/krw.png" style="width: 16px;"/> KRW:</span><a href="#"><?php echo number_format($krw->getValue()); ?></a></li>
                            <li><span class="color-1"><img src="/../assets/flag/rub.png" style="width: 16px;"/> RUB:</span><a href="#"><?php echo number_format($rub->getValue()); ?></a></li>
                        </ul>
                        <?php */ ?>
                    </div>
                </div>
<<<<<<< HEAD
            
=======
>>>>>>> 7e570f63114a4a4cbf8713921c245f09ac832c09
            </div>
        </div>
    </div>
    <div class="top_banner_wrap">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-4 col-sm-4">
                    <div class="header-logo">
                        <!-- logo -->
                        <a href="/">
                            <img class="td-retina-data img-responsive" src="/storage/app/public/{{$logo->bannerpath}}" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-xs-8 col-md-8 col-sm-8 hidden-xs">
                    <div class="header-banner">
                        <a href="{{$top_banner->url}}"><img class="td-retina img-responsive" src="/storage/app/public/{{$top_banner->bannerpath}}" alt=""></a>
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

                  @foreach($menus as $item)
                    <li id="menu_{{$item->id}}"><a href="{{$item->url}}" class="category04">{{$item->title}}</a> </li>
                    @endforeach
                </ul>
            </div>
            <!-- navbar-collapse -->
        </nav>
    </div>
</header>
