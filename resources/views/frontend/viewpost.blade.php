@extends('layouts.app')
@section('meta')
<meta property="fb:app_id" content="1835091203437157" />
<meta property="og:url" content="http://niigem.net/{{$post->category->slug}}/{{$post->id}}" />
<meta property="og:type" content="article" />
<meta property="og:title" content="{{$post->title}}" />
<meta property="og:description" content="{{str_limit($post->excerpt, 100)}}" />
<meta property="og:image" content="http://niigem.net{{str_replace('.', '-medium.',$post->image)}}" />
<meta property="og:image:url" content="http://niigem.net{{str_replace('.', '-medium.',$post->image)}}" />
@endsection
@section('css')
<style>
  .menu_active{
    background-color: #f60d2b;
    border-bottom: 1px solid transparent;
  }
  li.menu_active a{
    color: #fff;
  }
  .reply-form{
    display:none;
    margin-left: 100px;
    margin-top:20px;
}
</style>

@endsection
@section('content')
<div class="container">
      <div class="row"><br/><br/> </div>
    <div class="row">
        <div class="col-sm-8">
            <!--Post list-->
              <article class="content">
                <h3>{{$post->title}}</h3><br/>
                {{$post->plusView()}}

                <div class="date">

                  @if($post->user['avatar'])
                  <img src="{{$post->user['avatar']}}" class="img-responsive" alt="" style="float:left; height: 25px;  width: 25px;  border-radius: 50%;  margin-right: 6px;margin-top: -4px;">
                  @else
                  <img src="/assets/images/avatar.jpg" class="img-responsive" alt="">
                  @endif

                        <ul>
                            <li>Нийтэлсэн: <a title="" href="/reporter/{{$post->user['id']}}"><span>{{$post->user['name']}}</span></a> - </li>
                            <li><a title="" href="#"> {{ date('Y оны m-р сарын d', strtotime($post->created_at))}} </a> </li>
                        </ul>
                        <div style="float:right; text-align:right"><div class="fb-share-button" data-href="http://niigem.net/{{$post->category->slug}}/{{$post->id}}" data-layout="button" data-size="large" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse">  </a></div>
                        <a href="http://twitter.com/intent/tweet?text= {{$post->title}}  source=webclient"  class="twitter-share-button" data-size="large" data-show-count="false"> </a><script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
						</div>
                    </div>

                @if( $post->featured )
                <div id="gallery" style="display:none;">
                  @foreach($post->sliders() as $slide)
                  <img alt=""
                     src="{{str_replace($slide->file_name, 'thumb-'.$slide->file_name, $slide->path)}}"
                     data-image="{{$slide->path}}"
                     data-description="">
                 @endforeach
               </div><br/>
                @endif
                {!! $post->body !!}

         @if( $post->showcomment )     

                <div class="form-area">
                  <h3 class="category-headding ">Сэтгэгдэл үлдээх</h3>
                  <div class="headding-border"></div>
                  <form action="{{route('addComment')}}" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="postid" value="{{ $post->id }}">
                    <div class="row">
                      <div class="comment_comment" >
                      <textarea class="input_field" placeholder="Сэтгэгдлээ энд бичнэ үү" style="float:left;margin-left:25px;width:670px; height: 58px;margin-right:15px;" name="comment" id="message"></textarea>
                        </div>
                      <div class="comment_name">
                          <input class="input_field" type="text" placeholder="Нэрээ энд бичнэ үү" style="float:left;margin-left:25px;width:500px; height: 24px;margin-top: 10px;margin-right:15px; margin-bottom: 15px;" name="username" id="input-1">
                      </div>
                      <button type="submit" style="float:right; margin-top:10px;margin-right:15px;color: #FFF;background-color: #f60d2b;
                        border: 2px solid #f60d2b;">Сэтгэгдэл үлдээх</button>
                    </div>

                  </form>
                </div>

            <div class="comments-container">
                        <h4>Сэтгэгдэлүүд </h4>
                        <ul id="comments-list" class="comments-list">
                          @foreach($comments as $comment)
                            <li>
                                <div class="comment-main-level">
                                    <!-- Avatar -->
                                    <div class="comment-avatar">
                                      <i class="fa fa-user fa-2x"></i>
                                    </div>
                                    <!-- Contenedor del Comentario -->
                                    <div class="comment-box">
                                        <div class="comment-head">
                                          @if($comment->username == NULL)
                                            <h6 class="comment-name"><a href="#">Зочин</a></h6>
                                          @else
                                            <h6 class="comment-name"><a href="#">{{$comment->username}}</a></h6>
                                          @endif

                                            <span>{{date('M.d.Y', strtotime($comment->created_at))}}</span>
                                              <i class="reply_btn fa fa-reply"> Хариулах</i>
                                        </div>
                                        <div class="comment-content">
                                            {{$comment->comment}}
                                            <span style="float:right;">IP хаяг: {{$_SERVER['REMOTE_ADDR']}}</span>
                                        </div>
                                        <form class="reply-form" action="{{route('replyComment')}}" method="post" >
                                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                          <input type="hidden" name="postid" value="{{ $post->id }}">
                                          <input type="hidden" name="replyid" value="{{ $comment->id }}">
                                            <div class="row">
                                              <div class="comment_comment" >
                                              <textarea class="input_field" placeholder="Сэтгэгдлээ энд бичнэ үү" style="float:left;width:516px; height: 58px;margin-right:15px;" name="comment" id="message"></textarea>
                                                </div>
                                              <div class="comment_name">
                                                  <input class="input_field" type="text" placeholder="Нэрээ энд бичнэ үү" style="float:left;width:280px; height: 24px;margin-top: 10px;margin-right:15px; margin-bottom: 15px;" name="username" id="input-1">
                                              </div>
                                              <button type="submit" style="float:right; margin-top:10px; color: #FFF;background-color: #f60d2b;
                                                border: 2px solid #f60d2b;margin-right:15px;margin-left:10px">Сэтгэгдэл үлдээх</button>
                                                <button type="button" class="cancel_btn" style="float:right; margin-top:10px; color: #FFF;background-color: #f60d2b;
                                                  border: 2px solid #f60d2b;">хаах</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                                <ul class="comments-list reply-list">
                                  @foreach($comment->replies as $reply)
                                    <li>
                                        <!-- Avatar -->
                                        <div class="comment-avatar">
                                          <i class="fa fa-user fa-2x"></i>
                                        </div>
                                        <!-- Contenedor del Comentario -->
                                        <div class="comment-box">
                                            <div class="comment-head">
                                                <h6 class="comment-name"><a href="#">{{$reply->username}}</a></h6>
                                              <span>{{date('M.d.Y', strtotime($reply->created_at))}}</span>

                                            </div>
                                            <div class="comment-content">
                                              {{$reply->comment}}
                                              <span style="float:right;">IP хаяг: {{$_SERVER['REMOTE_ADDR']}}</span>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </li>
                            @endforeach
                        </ul>
                    </div>
          @endif
          </article>

        </div>
        @include('frontend.rigthmenu')
    </div>
</div>
@endsection
@section('javascript')
<script type='text/javascript' src='/assets/unitegallery/js/ug-common-libraries.js'></script>
	<script type='text/javascript' src='/assets/unitegallery/js/ug-functions.js'></script>
	<script type='text/javascript' src='/assets/unitegallery/js/ug-thumbsgeneral.js'></script>
	<script type='text/javascript' src='/assets/unitegallery/js/ug-thumbsstrip.js'></script>
	<script type='text/javascript' src='/assets/unitegallery/js/ug-touchthumbs.js'></script>
	<script type='text/javascript' src='/assets/unitegallery/js/ug-panelsbase.js'></script>
	<script type='text/javascript' src='/assets/unitegallery/js/ug-strippanel.js'></script>
	<script type='text/javascript' src='/assets/unitegallery/js/ug-gridpanel.js'></script>
	<script type='text/javascript' src='/assets/unitegallery/js/ug-thumbsgrid.js'></script>
	<script type='text/javascript' src='/assets/unitegallery/js/ug-tiles.js'></script>
	<script type='text/javascript' src='/assets/unitegallery/js/ug-tiledesign.js'></script>
	<script type='text/javascript' src='/assets/unitegallery/js/ug-avia.js'></script>
	<script type='text/javascript' src='/assets/unitegallery/js/ug-slider.js'></script>
	<script type='text/javascript' src='/assets/unitegallery/js/ug-sliderassets.js'></script>
	<script type='text/javascript' src='/assets/unitegallery/js/ug-touchslider.js'></script>
	<script type='text/javascript' src='/assets/unitegallery/js/ug-zoomslider.js'></script>
	<script type='text/javascript' src='/assets/unitegallery/js/ug-video.js'></script>
	<script type='text/javascript' src='/assets/unitegallery/js/ug-gallery.js'></script>
	<script type='text/javascript' src='/assets/unitegallery/js/ug-lightbox.js'></script>
	<script type='text/javascript' src='/assets/unitegallery/js/ug-carousel.js'></script>
	<script type='text/javascript' src='/assets/unitegallery/js/ug-api.js'></script>

	<link rel='stylesheet' href='/assets/unitegallery/css/unite-gallery.css' type='text/css' />

	<script type='text/javascript' src='/assets/unitegallery/themes/default/ug-theme-default.js'></script>
	<link rel='stylesheet' href='/assets/unitegallery/themes/default/ug-theme-default.css' type='text/css' />
  <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/mn_MN/sdk.js#xfbml=1&version=v2.8&appId=1835091203437157";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>
<script>

  $(function(){
    @if( $post->showcomment )
    $(".reply_btn").click(function () {
      $(this).parent().parent().children('.reply-form').show();
    });
    $(".cancel_btn").click(function(){
      $(this).parent().parent().hide();
    });

  @endif
  jQuery("#gallery").unitegallery();
});
</script>
@endsection
