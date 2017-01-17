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
                  <img class="entry-thumb" src="/storage/{{str_replace('.', '-medium.',$top_new->image)}}" style="width:257px;height:199px;object-fit: cover;">
                </a>
              </div>
              <div class="post-info">
                <span class="color-3">Мэдээ </span>
                <h3 class="post-title post-title-size"><a href="/{{$top_new->category['slug']}}/{{$top_new->id}}" rel="bookmark"> {{$top_new->title}} </a></h3>
                <div class="post-editor-date">
                  <!-- post date -->
                  <div class="post-date">
                    <i class="pe-7s-clock"></i> {{ date('M d, Y', strtotime($top_new->created_at)) }}
                  </div>
                  <!-- post comment -->
                  <div class="post-author-comment"><i class="pe-7s-comment"></i> {{$top_new->commentCount()}} </div>
                  <!-- read more -->
                  <a class="readmore pull-right" href="/{{$top_new->category['slug']}}/{{$top_new->id}}"><i class="pe-7s-angle-right"></i></a>
                </div>
              </div>
            </div>
          <?php elseif($i == 2):?>
            <div class="post-wrapper post-grid-2 wow fadeIn" data-wow-duration="2s">
              <div class="post-thumb img-zoom-in">
                <a href="#">
                  <img class="entry-thumb" src="/storage/{{str_replace('.', '-medium.',$top_new->image)}}" style="width:257px;height:199px;object-fit: cover;">
                </a>
              </div>
              <div class="post-info">
                <span class="color-5">Мэдээ</span>
                <h3 class="post-title post-title-size"><a href="/{{$top_new->category['slug']}}/{{$top_new->id}}" rel="bookmark">{{$top_new->title}} </a></h3>
                <div class="post-editor-date">
                  <!-- post date -->
                  <div class="post-date">
                    <i class="pe-7s-clock"></i> {{ date('M d, Y', strtotime($top_new->created_at)) }}
                  </div>
                  <!-- post comment -->
                  <div class="post-author-comment"><i class="pe-7s-comment"></i> {{$top_new->commentCount()}} </div>
                  <!-- read more -->
                  <a class="readmore pull-right" href="/{{$top_new->category['slug']}}/{{$top_new->id}}"><i class="pe-7s-angle-right"></i></a>
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
                    <img class="entry-thumb-middle" src="/storage/{{str_replace('.', '-medium.',$top_new->image)}}" style="width:519px;height:400px;object-fit: cover;">
                  </a>
                </div>
                <div class="post-info">
                  <span class="color-4">Мэдээ</span>
                  <h3 class="post-title"><a href="/{{$top_new->category['slug']}}/{{$top_new->id}}" rel="bookmark">{{$top_new->title}} </a></h3>
                  <div class="post-editor-date">
                    <!-- post date -->
                    <div class="post-date">
                      <i class="pe-7s-clock"></i> {{ date('M d, Y', strtotime($top_new->created_at)) }}
                    </div>
                    <!-- post comment -->
                    <div class="post-author-comment"><i class="pe-7s-comment"></i> {{$top_new->commentCount()}} </div>
                    <!-- read more -->
                    <a class="readmore pull-right" href="/{{$top_new->category['slug']}}/{{$top_new->id}}"><i class="pe-7s-angle-right"></i></a>
                  </div>
                </div>
              </div>
            <?php endif;?>
          <?php $i++; endforeach;?>
        </div>

        <div class="col-sm-3 col-padding">
          <?php $i = 1; foreach($top_news as $top_new): ?>
            <?php if($i == 4):?>

              <div class="post-wrapper post-grid-4 wow fadeIn" data-wow-duration="2s">
                <div class="post-thumb img-zoom-in">
                  <a href="#">
                    <img class="entry-thumb" src="/storage/{{str_replace('.', '-medium.',$top_new->image)}}" style="width:257px;height:199px;object-fit: cover;">
                  </a>
                </div>
                <div class="post-info">
                  <span class="color-1">Мэдээ</span>
                  <h3 class="post-title post-title-size"><a href="/{{$top_new->category['slug']}}/{{$top_new->id}}" rel="bookmark">{{$top_new->title}}</a></h3>
                  <div class="post-editor-date">
                    <!-- post date -->
                    <div class="post-date">
                      <i class="pe-7s-clock"></i> {{ date('M d, Y', strtotime($top_new->created_at)) }}
                    </div>
                    <!-- post comment -->
                    <div class="post-author-comment"><i class="pe-7s-comment"></i> {{$top_new->commentCount()}} </div>
                    <!-- read more -->
                    <a class="readmore pull-right" href="/{{$top_new->category['slug']}}/{{$top_new->id}}"><i class="pe-7s-angle-right"></i></a>
                  </div>
                </div>
              </div>
            <?php endif; ?>
          <?php $i++;  endforeach;?>
          <?php $i = 1; foreach($top_news as $top_new): ?>
            <?php if($i == 5):?>
              <div class="post-wrapper post-grid-5 wow fadeIn" data-wow-duration="2s">
                <div class="post-thumb img-zoom-in">
                  <a href="#">
                    <img class="entry-thumb" src="/storage/{{str_replace('.', '-medium.',$top_new->image)}}" style="width:257px;height:199px;object-fit: cover;">
                  </a>
                </div>
                <div class="post-info">
                  <span class="color-2">Мэдээ</span>
                  <h3 class="post-title post-title-size"><a href="/{{$top_new->category['slug']}}/{{$top_new->id}}" rel="bookmark">{{$top_new->title}} </a></h3>
                  <div class="post-editor-date">
                    <!-- post date -->
                    <div class="post-date">
                      <i class="pe-7s-clock"></i> {{ date('M d, Y', strtotime($top_new->created_at)) }}
                    </div>
                    <!-- post comment -->
                    <div class="post-author-comment"><i class="pe-7s-comment"></i> {{$top_new->commentCount()}} </div>
                    <!-- read more -->
                    <a class="readmore pull-right" href="/{{$top_new->category['slug']}}/{{$top_new->id}}"><i class="pe-7s-angle-right"></i></a>
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
                    <div class="img-thumb">
                      <a href="#">
                        <img class="entry-thumb" height="90" src="/storage/{{str_replace('.', '-medium.',$tur->image)}}" style="width:214px;height:126px;object-fit: cover;">
                      </a>
                    </div>
                  </div>
                  <div class="post-title-author-details">
                    <h4><a href="/{{$tur->category['slug']}}/{{$tur->id}}">{{$tur->title}}</a></h4>
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
                    <div class="img-thumb">
                      <a href="#">
                        <img class="entry-thumb" height="90" src="/storage/{{str_replace('.', '-medium.',$zasag->image)}}" style="width:214px;height:126px;object-fit: cover;">
                      </a>
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
                    <div class="img-thumb">
                      <a href="#">
                        <img class="entry-thumb" height="90" src="/storage/{{str_replace('.', '-medium.',$del->image)}}" style="width:214px;height:126px;object-fit: cover;">
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
            <a href="#"><img src="/storage/{{$footer_banner->bannerpath}}" class="img-responsive center-block" alt=""></a>
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
                        <img class="img-responsive" src="/storage/{{str_replace('.', '-medium.',$video->image)}}" style="width:214px;height:126px;object-fit: cover;">
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
        @include('frontend.rigthmenu')
        <!-- side content end -->
      </div>
      <!-- row end -->
    </div>
    @endsection
