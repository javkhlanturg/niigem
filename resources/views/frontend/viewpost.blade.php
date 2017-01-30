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
  .reply-form{
    display:none;
    margin-left: 100px;
    margin-top:20px;
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
                <h3>{{$post->title}}</h3>
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
                    </div>
                @if( $post->featured )
                <div id="gallery" style="display:none;">
                  @foreach($post->sliders() as $slide)
                  <img alt=""
                     src="{{str_replace($slide->file_name, 'thumb-'.$slide->file_name, $slide->path)}}"
                     data-image="{{$slide->path}}"
                     data-description="">
                 @endforeach
                </div>
                @endif
                {!! $post->body !!}

              </article>
              <div class="social" style="float:right">
                <div data-easyshare data-easyshare-url="http://www.niigem.net/">
                  <!-- Total -->
                  <button data-easyshare-button="total">
                    <span>Total</span>
                  </button>
                  <span data-easyshare-total-count>0</span>

                  <!-- Twitter -->
                  <button data-easyshare-button="twitter" data-easyshare-tweet-text="{{$post->title}}" style="margin-right:15px;">
                    <span class="fa fa-twitter"></span>
                    <span>Tweet</span>
                  </button>

                  <!-- Facebook -->
                  <button data-easyshare-button="facebook">
                    <span class="fa fa-facebook"></span>
                    <span>Share</span>
                  </button>
                  <span data-easyshare-button-count="facebook">0</span>

                  <!-- Google+ -->
                  <button data-easyshare-button="google">
                    <span class="fa fa-google-plus"></span>
                    <span>+1</span>
                  </button>
                  <span data-easyshare-button-count="google">0</span>

                  <!-- LinkedIn -->
                  <button data-easyshare-button="linkedin">
                    <span class="fa fa-linkedin"></span>
                  </button>
                  <span data-easyshare-button-count="linkedin">0</span>

                  <!-- Pinterest -->
                  <button data-easyshare-button="pinterest">
                    <span class="fa fa-pinterest-p"></span>
                  </button>
                  <span data-easyshare-button-count="pinterest">0</span>

                  <!-- Xing -->
                  <button data-easyshare-button="xing">
                    <span class="fa fa-xing"></span>
                  </button>
                  <span data-easyshare-button-count="xing">0</span>

                  <div data-easyshare-loader>Loading...</div>
                </div>
              </div>
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
                                    <div class="comment-avatar">
                                      <i class="fa fa-user fa-2x"></i>
                                    </div>
                                    <!-- Contenedor del Comentario -->
                                    <div class="comment-box">
                                        <div class="comment-head">
                                            <h6 class="comment-name"><a href="#">{{$comment->username}}</a></h6>
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
                                                    <button type="button" class="btn btn-style cancel_btn" style="float: right;">хаах</button>
                                                </div>
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

          </div>

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
	<link rel='stylesheet' 		  href='/assets/unitegallery/themes/default/ug-theme-default.css' type='text/css' />
<script>
$(function(){
    $(".reply_btn").click(function () {
      $(this).parent().parent().children('.reply-form').show();
    });
    $(".cancel_btn").click(function(){
      $(this).parent().parent().hide();
    });
});
</script>
<script type="text/javascript">

		jQuery(document).ready(function(){

			jQuery("#gallery").unitegallery();

		});

	</script>
<script>
  $(document).ready(function(){

  });
</script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<link rel="stylesheet" href="/assets/dist/jquery.kyco.easyshare.css">
<script src="/assets/dist/jquery-1.11.3.min.js"></script>
<script>
  $.each($('.advanced [data-easyshare-button-count] + [data-easyshare-loader]'), function(i, e) {
    var el        = $(e);
    var done      = false;
    var attr      = el.prev().attr('data-easyshare-button-count')
    var target    = document.querySelector('.advanced [data-easyshare-button-count="' + attr + '"] + [data-easyshare-loader]');
    var startDate = new Date().getTime() / 1000;
    var endDate;

    var observer = new MutationObserver(function(mutations) {
      if (!done) {
        done = true;
        endDate = new Date().getTime() / 1000;
        el.after('Loaded in roughly ', (endDate - startDate).toFixed(2), 's');
      }
    });

    observer.observe(target, {
      attributes: true
    });
  });
</script>
<script src="/assets/dist/jquery.kyco.easyshare.js"></script>
@endsection
