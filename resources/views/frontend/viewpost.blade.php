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
                    <img src="/storage/app/public/{{$post->image}}" class="img-responsive post-image" alt="">
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
                                    <div class="comment-avatar">
                                      <i class="fa fa-user fa-2x"></i>
                                    </div>
                                    <!-- Contenedor del Comentario -->
                                    <div class="comment-box">
                                        <div class="comment-head">
                                            <h6 class="comment-name"><a href="#">{{$comment->username}}</a></h6>
                                            <span>{{date('M.d.Y', strtotime($comment->created_at))}}</span>
                                            @if(1===0)
                                            <i class="fa fa-reply"></i>
                                            <i class="fa fa-heart"></i>
                                            @endif
                                            <h6 style="float:right">IP хаяг: {{$_SERVER['REMOTE_ADDR']}}</h6>
                                        </div>
                                        <div class="comment-content">
                                            {{$comment->comment}}
                                            <span style="float:right;">хариулах</span>
                                        </div>

                                    </div>
                                </div>
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
<script>
  $(document).ready(function(){
    @if($menu)
    $('#menu_{{$menu->id}}').addClass('menu_active');
    @endif
  });
</script>
@endsection
