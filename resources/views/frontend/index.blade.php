@extends('layouts.app')

@section('content')
<section class="headding-news">
  <div class="container">
    <div class="row row-margin">

      <div class="col-sm-3 col-padding">
        <?php $i = 1; foreach($top_news as $top_new): ?>
          <?php if($i == 1): ?>
            <div class="post-wrapper post-grid-1 wow fadeIn" data-wow-duration="2s">
              <div class="post-thumb img-zoom-in">
                <a href="#">
                  <img class="entry-thumb" src="\assets\images\slider\slide-06.jpg" alt="">
                </a>
              </div>
              <div class="post-info">
                <span class="color-3">Мэдээ </span>
                <h3 class="post-title post-title-size"><a href="#" rel="bookmark"> {{$top_new->title}} </a></h3>
                <div class="post-editor-date">
                  <!-- post date -->
                  <div class="post-date">
                    <i class="pe-7s-clock"></i> {{ date('M d, Y', strtotime($top_new->created_at)) }}
                  </div>
                  <!-- post comment -->
                  <div class="post-author-comment"><i class="pe-7s-comment"></i> 13 </div>
                  <!-- read more -->
                  <a class="readmore pull-right" href="#"><i class="pe-7s-angle-right"></i></a>
                </div>
              </div>
            </div>
          <?php elseif($i == 2):?>
            <div class="post-wrapper post-grid-2 wow fadeIn" data-wow-duration="2s">
              <div class="post-thumb img-zoom-in">
                <a href="#">
                  <img class="entry-thumb" src="\assets\images\slider\slide-07.jpg" alt="">
                </a>
              </div>
              <div class="post-info">
                <span class="color-5">Мэдээ</span>
                <h3 class="post-title post-title-size"><a href="#" rel="bookmark">{{$top_new->title}} </a></h3>
                <div class="post-editor-date">
                  <!-- post date -->
                  <div class="post-date">
                    <i class="pe-7s-clock"></i> {{ date('M d, Y', strtotime($top_new->created_at)) }}
                  </div>
                  <!-- post comment -->
                  <div class="post-author-comment"><i class="pe-7s-comment"></i> 13 </div>
                  <!-- read more -->
                  <a class="readmore pull-right" href="#"><i class="pe-7s-angle-right"></i></a>
                </div>
              </div>
            </div>
          <?php endif; ?>
          <?php $i++; endforeach;?>
        </div>

        <div class="col-sm-6 col-padding">
          <?php $i = 1; foreach($top_news as $top_new): ?>
            <?php if($i == 3):?>
              <div class="post-wrapper post-grid-3 wow fadeIn" data-wow-duration="2s">
                <div class="post-thumb img-zoom-in">
                  <a href="#">
                    <img class="entry-thumb-middle" src="\assets\images\slider\slide-08.jpg" alt="">
                  </a>
                </div>
                <div class="post-info">
                  <span class="color-4">Мэдээ</span>
                  <h3 class="post-title"><a href="#" rel="bookmark">{{$top_new->title}} </a></h3>
                  <div class="post-editor-date">
                    <!-- post date -->
                    <div class="post-date">
                      <i class="pe-7s-clock"></i> {{ date('M d, Y', strtotime($top_new->created_at)) }}
                    </div>
                    <!-- post comment -->
                    <div class="post-author-comment"><i class="pe-7s-comment"></i> 13 </div>
                    <!-- read more -->
                    <a class="readmore pull-right" href="#"><i class="pe-7s-angle-right"></i></a>
                  </div>
                </div>
              </div>
            <?php endif;?>
          <?php endforeach;?>
        </div>

        <div class="col-sm-3 col-padding">
          <?php $i = 1; foreach($top_news as $top_new): ?>
            <?php if($i == 4):?>

              <div class="post-wrapper post-grid-4 wow fadeIn" data-wow-duration="2s">
                <div class="post-thumb img-zoom-in">
                  <a href="#">
                    <img class="entry-thumb" src="\assets\images\slider\slide-09.jpg" alt="">
                  </a>
                </div>
                <div class="post-info">
                  <span class="color-1">Мэдээ</span>
                  <h3 class="post-title post-title-size"><a href="#" rel="bookmark">{{$top_new->title}}</a></h3>
                  <div class="post-editor-date">
                    <!-- post date -->
                    <div class="post-date">
                      <i class="pe-7s-clock"></i> {{ date('M d, Y', strtotime($top_new->created_at)) }}
                    </div>
                    <!-- post comment -->
                    <div class="post-author-comment"><i class="pe-7s-comment"></i> 13 </div>
                    <!-- read more -->
                    <a class="readmore pull-right" href="#"><i class="pe-7s-angle-right"></i></a>
                  </div>
                </div>
              </div>
            <?php endif; ?>
          <?php endforeach;?>
          <?php $i = 1; foreach($top_news as $top_new): ?>
            <?php if($i == 5):?>
              <div class="post-wrapper post-grid-5 wow fadeIn" data-wow-duration="2s">
                <div class="post-thumb img-zoom-in">
                  <a href="#">
                    <img class="entry-thumb" src="\assets\images\slider\slide-10.jpg" alt="">
                  </a>
                </div>
                <div class="post-info">
                  <span class="color-2">Мэдээ</span>
                  <h3 class="post-title post-title-size"><a href="#" rel="bookmark">{{$top_new->title}} </a></h3>
                  <div class="post-editor-date">
                    <!-- post date -->
                    <div class="post-date">
                      <i class="pe-7s-clock"></i> {{ date('M d, Y', strtotime($top_new->created_at)) }}
                    </div>
                    <!-- post comment -->
                    <div class="post-author-comment"><i class="pe-7s-comment"></i> 13 </div>
                    <!-- read more -->
                    <a class="readmore pull-right" href="#"><i class="pe-7s-angle-right"></i></a>
                  </div>
                </div>
              </div>
            <?php endif; ?>
            <?php $i++; endforeach;?>
          </div>

        </div>
      </div>
    </section>
    <div class="container">
      <div class="row">
        <div class="col-md-8 col-sm-8">


          <section class="recent_news_inner">
            <h3 class="category-headding ">Улс төр</h3>
            <div class="headding-border"></div>

            <div class="row rn_block">
              @foreach($uls_turs as $tur)
              <div class="col-md-4 col-sm-4 padd">
                <div class="home2-post">
                  <div class="post-wrapper wow fadeIn" data-wow-duration="1s">
                    <!-- image -->
                    <div class="post-thumb">
                      <a href="#">
                        <img class="img-responsive" src="/assets/images/recent_news_04.jpg" alt="">
                      </a>
                    </div>
                    <div class="post-info meta-info-rn">
                      <div class="slide">
                        <a target="_blank" href="#" class="post-badge btn_eight">У</a>
                      </div>
                    </div>
                  </div>
                  <div class="post-title-author-details">
                    <h4><a href="#">{{$tur->title}}</a></h4>
                    <div class="date">
                      <ul>
                        <li>By <a title="" href="#"><span>Админ</span></a> --</li>
                        <li><a title="" href="#">{{ date('M d, Y', strtotime($tur->created_at)) }}</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              @endforeach

            </div>
          </section>
          <section class="politics_wrapper">
            <h3 class="category-headding ">Эдийн засаг</h3>
            <div class="headding-border"></div>
            <div class="row rn_block">
              @foreach($zasags as $zasag)
              <div class="col-md-4 col-sm-4 padd">
                <div class="home2-post">
                  <div class="post-wrapper wow fadeIn" data-wow-duration="1s">
                    <!-- image -->
                    <div class="post-thumb">
                      <a href="#">
                        <img class="img-responsive" src="/storage/{{$zasag->image}}" alt="">
                      </a>
                    </div>
                    <div class="post-info meta-info-rn">
                      <div class="slide">
                        <a target="_blank" href="#" class="post-badge btn_eight">У</a>
                      </div>
                    </div>
                  </div>
                  <div class="post-title-author-details">
                    <h4><a href="#">{{$zasag->title}}</a></h4>
                    <div class="date">
                      <ul>
                        <li>By <a title="" href="#"><span>Админ</span></a> --</li>
                        <li><a title="" href="#">{{ date('M d, Y', strtotime($zasag->created_at)) }}</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              @endforeach

            </div>
          </section>
          <section class="politics_wrapper">
            <h3 class="category-headding ">Дэлхий</h3>
            <div class="headding-border"></div>
            <div class="row rn_block">
              @foreach($delhiis as $del)
              <div class="col-md-4 col-sm-4 padd">
                <div class="home2-post">
                  <div class="post-wrapper wow fadeIn" data-wow-duration="1s">
                    <!-- image -->
                    <div class="post-thumb">
                      <a href="#">
                        <img class="img-responsive" src="/storage/{{$del->image}}" alt="">
                      </a>
                    </div>
                    <div class="post-info meta-info-rn">
                      <div class="slide">
                        <a target="_blank" href="#" class="post-badge btn_eight">У</a>
                      </div>
                    </div>
                  </div>
                  <div class="post-title-author-details">
                    <h4><a href="#">{{$del->title}}</a></h4>
                    <div class="date">
                      <ul>
                        <li>By <a title="" href="#"><span>Админ</span></a> --</li>
                        <li><a title="" href="#">{{ date('M d, Y', strtotime($del->created_at)) }}</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              @endforeach

            </div>
          </section>
          <!-- /.Politics -->
          <div class="ads">
            <a href="#"><img src="\assets\images\top-bannner2.jpg" class="img-responsive center-block" alt=""></a>
          </div>
          <section class="politics_wrapper">
            <h3 class="category-headding ">Видео</h3>
            <div class="headding-border"></div>
            <div class="row rn_block">
              @foreach($videos as $video)
              <div class="col-md-4 col-sm-4 padd">
                <div class="home2-post">
                  <div class="post-wrapper wow fadeIn" data-wow-duration="1s">
                    <!-- image -->
                    <div class="post-thumb">

                      <a href="#" class="video-img-icon">
                        <i class="fa fa-play"></i>
                        <img class="img-responsive" src="\assets\images\recent_news_04.jpg" alt="">
                      </a>
                    </div>

                  </div>
                  <div class="post-title-author-details">
                    <h4><a href="#">{{$video->title}}</a></h4>

                  </div>
                </div>
              </div>
              @endforeach

            </div>
          </section>
        </div>
        <!-- /.left content inner -->
        <div class="col-md-4 col-sm-4 left-padding">



          <div class="tab-inner">
            <ul class="tabs">
              <li><a href="#">Сүүлд нэмэгдсэн мэдээ</a></li>

            </ul>
            <hr>
            <!-- tabs -->
            <div class="tab_content">
              <div class="tab-item-inner">
                @foreach($newss as $news)
                <div class="box-item wow fadeIn" data-wow-duration="1s">
                  <div class="img-thumb">
                    <a href="#" rel="bookmark"><img class="entry-thumb" src="\assets\images\popular_news_01.jpg" alt="" height="80" width="90"></a>
                  </div>
                  <div class="item-details">
                    <h6 class="sub-category-title bg-color-1">
                      <a href="#">SPORTS</a>
                    </h6>
                    <h3 class="td-module-title"><a href="#">{{$news->title}}</a></h3>
                    <div class="post-editor-date">
                      <!-- post date -->
                      <div class="post-date">
                        <i class="pe-7s-clock"></i> {{ date('M d, Y', strtotime($news->created_at)) }}
                      </div>
                      <!-- post comment -->
                      <div class="post-author-comment"><i class="pe-7s-comment"></i> 13 </div>
                    </div>
                  </div>
                </div>
                @endforeach
              </div>
              <!-- / tab item -->

              <!-- / tab item -->
            </div>
            <!-- / tab_content -->
          </div>
          <!-- / tab -->
          <div class="banner-add">
            <!-- add -->
            <span class="add-title">- Advertisement -</span>
            <a href="#"><img src="\assets\images\ad-banner.jpg" class="img-responsive center-block" alt=""></a>
          </div>
          <!-- comments -->
          <div class="latest-comments-inner">
            <h3 class="category-headding ">LATEST COMMENT</h3>
            <div class="headding-border"></div>
            <!-- latest comment post -->
            <div class="post-style2 latest-com">
              <img src="\assets\images\comment-01.jpg" alt="">
              <div class="latest-com-detail">
                <h5><a href="#" title="">It uses a dictionary of over</a></h5>
                <span>Nec sagittis sem nibh dictionary...</span>
                <p>Proin gravida nibh vel velit auctor aliquet. </p>
              </div>
            </div>
            <!-- latest comment post -->
            <div class="post-style2 latest-com">
              <img src="\assets\images\comment-02.jpg" alt="">
              <div class="latest-com-detail">
                <h5><a href="#" title="">It uses a dictionary of over</a></h5>
                <span>Nec sagittis sem nibh dictionary...</span>
                <p>Proin gravida nibh vel velit auctor aliquet. </p>
              </div>
            </div>
          </div>
        </div>
        <!-- side content end -->
      </div>
      <!-- row end -->
    </div>
    @endsection
