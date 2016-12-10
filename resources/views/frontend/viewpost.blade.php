@extends('layouts.app')
@section('css')
<style>
  .menu_active{
    background-color: #f60d2b;
    border-bottom: 1px solid transparent;
  }
  li.menu_active a{
    color: #fff;
  }
</style>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            &nbsp;
        </div>
    </div>
<div class="container">
    <div class="row">
        <div class="col-sm-8">
            <!--Post list-->
            <div class="row">
              <article class="content">
                <div class="post-thumb">
                    <img src="/storage/{{$post->image}}" class="img-responsive post-image" alt="">
                    @if(1=== 0)
                    <div class="social">
                        <ul>
                            <li><a href="#" class="facebook"><i class="fa  fa-facebook"></i><span>3987</span> </a></li>
                            <li><a href="#" class="twitter"><i class="fa  fa-twitter"></i><span>3987</span></a></li>
                            <li><a href="#" class="google"><i class="fa  fa-google-plus"></i><span>3987</span></a></li>
                            <li><a href="#" class="flickr"><i class="fa fa-flickr"></i><span>3987</span> </a></li>
                        </ul>
                    </div>
                    @endif
                    <!-- /.social icon -->
                </div>
                <h1>{{$post->title}}</h1>
                {!! $post->body !!}
              </article>
          </div>
          <div class="row">
            <div class="form-area">
                        <h3 class="category-headding ">Сэтгэгдэл үлдээх</h3>
                        <div class="headding-border"></div>
                        <form action="{{route('addComment')}}" method="post">
                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                          <input type="hidden" name="postid" value="{{ $post->id }}">
                            <div class="row">
                                <div class="col-sm-6">
                                    <span class="input">
                                            <input class="input_field" type="text" name="username" id="input-1">
                                            <label class="input_label" for="input-1">
                                                <span class="input_label_content" data-content="Та энэ хэсэгт нэрээ оруулна уу">Нэр</span>
                                    </label>
                                    </span>
                                </div>
                                <div class="col-sm-12">
                                    <span class="input">
                                            <textarea class="input_field" name="comment" id="message"></textarea>
                                            <label class="input_label" for="message">
                                                <span class="input_label_content" data-content="Сэтгэгдэлээ оруулна уу">Сэтгэгдэл</span>
                                    </label>
                                    </span>
                                    <button type="submit" class="btn btn-style">Сэтгэгдэл үлдээх</button>
                                </div>
                            </div>
                        </form>
                    </div>
          </div>
          <div class="row">
            <div class="comments-container">
                        <h1>Сэтгэгдэлүүд </h1>
                        <ul id="comments-list" class="comments-list">
                          @foreach($comments as $comment)
                            <li>
                                <div class="comment-main-level">
                                    <!-- Avatar -->
                                    <div class="comment-avatar"><img src="\assets\images\comment-02.jpg" class="img-circle" alt=""></div>
                                    <!-- Contenedor del Comentario -->
                                    <div class="comment-box">
                                        <div class="comment-head">
                                            <h6 class="comment-name"><a href="#">{{$comment->username}}</a></h6>
                                            <span>{{date('Y.m.d H:i', strtotime($comment->created_at))}}</span>
                                            @if(1===0)
                                            <i class="fa fa-reply"></i>
                                            <i class="fa fa-heart"></i>
                                            @endif
                                        </div>
                                        <div class="comment-content">
                                            {{$comment->comment}}
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
          </div>
        </div>
        <aside class="col-sm-4 left-padding">
            <div class="input-group search-area">
                <!-- search area -->
                <input type="text" class="form-control" placeholder="Search articles here ..." name="q">
                <div class="input-group-btn">
                    <button class="btn btn-search" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                </div>
            </div>
            <!-- social icon -->
            <h3 class="category-headding ">SOCIAL PIXEL</h3>
            <div class="headding-border"></div>
            <div class="social">
                <ul>
                    <li><a href="#" class="facebook"><i class="fa  fa-facebook"></i><span>3987</span> </a></li>
                    <li><a href="#" class="twitter"><i class="fa  fa-twitter"></i><span>3987</span></a></li>
                    <li><a href="#" class="google"><i class="fa  fa-google-plus"></i><span>3987</span></a></li>
                    <li><a href="#" class="flickr"><i class="fa fa-flickr"></i><span>3987</span> </a></li>
                </ul>
            </div>
            <!-- /.social icon -->
            <div class="tab-inner">
                <ul class="tabs">
                    <li><a href="#">POPULAR</a></li>
                    <li><a href="#">MOST VIEWED</a></li>
                </ul>
                <hr>
                <!-- tabs -->
                <div class="tab_content">
                    <div class="tab-item-inner">
                        <div class="box-item wow fadeIn" data-wow-duration="1s">
                            <div class="img-thumb">
                                <a href="#" rel="bookmark"><img class="entry-thumb" src="\assets\images\popular_news_01.jpg" alt="" height="80" width="90"></a>
                            </div>
                            <div class="item-details">
                                <h6 class="sub-category-title bg-color-1">
                                        <a href="#">SPORTS</a>
                                    </h6>
                                <h3 class="td-module-title"><a href="#">It is a long established fact that a reader will</a></h3>
                                <div class="post-editor-date">
                                    <!-- post date -->
                                    <div class="post-date">
                                        <i class="pe-7s-clock"></i> Oct 6, 2016
                                    </div>
                                    <!-- post comment -->
                                    <div class="post-author-comment"><i class="pe-7s-comment"></i> 13 </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-item wow fadeIn" data-wow-duration="1s" data-wow-delay="0.1s">
                            <div class="img-thumb">
                                <a href="#" rel="bookmark"><img class="entry-thumb" src="\assets\images\popular_news_02.jpg" alt="" height="80" width="90"></a>
                            </div>
                            <div class="item-details">
                                <h6 class="sub-category-title bg-color-2">
                                        <a href="#">TECHNOLOGY </a>
                                    </h6>
                                <h3 class="td-module-title"><a href="#">The generated Lorem Ipsum is therefore</a></h3>
                                <div class="post-editor-date">
                                    <!-- post date -->
                                    <div class="post-date">
                                        <i class="pe-7s-clock"></i> Oct 6, 2016
                                    </div>
                                    <!-- post comment -->
                                    <div class="post-author-comment"><i class="pe-7s-comment"></i> 13 </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-item wow fadeIn" data-wow-duration="1s" data-wow-delay="0.2s">
                            <div class="img-thumb">
                                <a href="#" rel="bookmark"><img class="entry-thumb" src="\assets\images\popular_news_03.jpg" alt="" height="80" width="90"></a>
                            </div>
                            <div class="item-details">
                                <h6 class="sub-category-title bg-color-3">
                                        <a href="#">HEALTH</a>
                                    </h6>
                                <h3 class="td-module-title"><a href="#">The standard chunk of Lorem Ipsum used since</a></h3>
                                <div class="post-editor-date">
                                    <!-- post date -->
                                    <div class="post-date">
                                        <i class="pe-7s-clock"></i> Oct 6, 2016
                                    </div>
                                    <!-- post comment -->
                                    <div class="post-author-comment"><i class="pe-7s-comment"></i> 13 </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-item wow fadeIn" data-wow-duration="1s" data-wow-delay="0.3s">
                            <div class="img-thumb">
                                <a href="#" rel="bookmark"><img class="entry-thumb" src="\assets\images\popular_news_04.jpg" alt="" height="80" width="90"></a>
                            </div>
                            <div class="item-details">
                                <h6 class="sub-category-title bg-color-4">
                                        <a href="#">FASHION</a>
                                    </h6>
                                <h3 class="td-module-title"><a href="#">Lorem Ipum therefore always free from</a></h3>
                                <div class="post-editor-date">
                                    <!-- post date -->
                                    <div class="post-date">
                                        <i class="pe-7s-clock"></i> Oct 6, 2016
                                    </div>
                                    <!-- post comment -->
                                    <div class="post-author-comment"><i class="pe-7s-comment"></i> 13 </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- / tab item -->
                    <div class="tab-item-inner">
                        <div class="box-item">
                            <div class="img-thumb">
                                <a href="#" rel="bookmark"><img class="entry-thumb" src="\assets\images\popular_news_01.jpg" alt="" height="80" width="90"></a>
                            </div>
                            <div class="item-details">
                                <h6 class="sub-category-title bg-color-5">
                                        <a href="#">BUSINESS</a>
                                    </h6>
                                <h3 class="td-module-title"><a href="#">It is a long established fact that a reader will</a></h3>
                                <div class="post-editor-date">
                                    <!-- post date -->
                                    <div class="post-date">
                                        <i class="pe-7s-clock"></i> Oct 6, 2016
                                    </div>
                                    <!-- post comment -->
                                    <div class="post-author-comment"><i class="pe-7s-comment"></i> 13 </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-item">
                            <div class="img-thumb">
                                <a href="#" rel="bookmark"><img class="entry-thumb" src="\assets\images\popular_news_02.jpg" alt="" height="80" width="90"></a>
                            </div>
                            <div class="item-details">
                                <h6 class="sub-category-title bg-color-2">
                                        <a href="#">TECHNOLOGY </a>
                                    </h6>
                                <h3 class="td-module-title"><a href="#">The generated Lorem Ipsum is therefore</a></h3>
                                <div class="post-editor-date">
                                    <!-- post date -->
                                    <div class="post-date">
                                        <i class="pe-7s-clock"></i> Oct 6, 2016
                                    </div>
                                    <!-- post comment -->
                                    <div class="post-author-comment"><i class="pe-7s-comment"></i> 13 </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-item">
                            <div class="img-thumb">
                                <a href="#" rel="bookmark"><img class="entry-thumb" src="\assets\images\popular_news_03.jpg" alt="" height="80" width="90"></a>
                            </div>
                            <div class="item-details">
                                <h6 class="sub-category-title bg-color-3">
                                        <a href="#">HEALTH</a>
                                    </h6>
                                <h3 class="td-module-title"><a href="#">The standard chunk of Lorem Ipsum used since</a></h3>
                                <div class="post-editor-date">
                                    <!-- post date -->
                                    <div class="post-date">
                                        <i class="pe-7s-clock"></i> Oct 6, 2016
                                    </div>
                                    <!-- post comment -->
                                    <div class="post-author-comment"><i class="pe-7s-comment"></i> 13 </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-item">
                            <div class="img-thumb">
                                <a href="#" rel="bookmark"><img class="entry-thumb" src="\assets\images\popular_news_04.jpg" alt="" height="80" width="90"></a>
                            </div>
                            <div class="item-details">
                                <h6 class="sub-category-title bg-color-4">
                                        <a href="#">FASHION</a>
                                    </h6>
                                <h3 class="td-module-title"><a href="#">Lorem Ipum therefore always free from</a></h3>
                                <div class="post-editor-date">
                                    <!-- post date -->
                                    <div class="post-date">
                                        <i class="pe-7s-clock"></i> Oct 6, 2016
                                    </div>
                                    <!-- post comment -->
                                    <div class="post-author-comment"><i class="pe-7s-comment"></i> 13 </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
        </aside>
    </div>
</div>
@endsection
@section('javascript')
<script>
  $(document).ready(function(){
    $('#menu_{{$menu->id}}').addClass('menu_active');
  });
</script>
@endsection
