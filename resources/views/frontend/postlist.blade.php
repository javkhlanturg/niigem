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
            @foreach($posts as $item)
            <div class="post-style2 wow fadeIn" data-wow-duration="1s">
                <a href="#"><img src="{{str_replace('.', '-medium.',$item->image)}}" style="max-width:250px" alt=""></a>
                <div class="post-style2-detail">
                    <h3><a href="/{{$item->category->slug}}/{{$item->id}}" title="">{{$item->title}}</a></h3>
                    <div class="date">
                        <ul>
                            <li>
                              @if($item->user['avatar'])
                              <img src="{{$item->user['avatar']}}" class="img-responsive" alt=""></li>
                              @else
                                <img src="/assets/images/avatar.jpg" class="img-responsive" alt="">
                              @endif
                            <li style="font-family:'Lato', sans-serif;">Нийтэлсэн <a title="" href="#"><span>{{$item->user['name']}}</span></a> --</li>
                            <li><a title="" href="#">{{date('Y.m.d', strtotime($item->created_at))}}</a> --</li>
                            <li><a title="" href="#"><span>{{$item->commentCount()}} сэтгэгдэлтэй</span></a></li>
                        </ul>
                    </div>
                    <p>{{str_limit($item->excerpt, 100)}}</p>
                    <a href="/{{$item->category->slug}}/{{$item->id}}" class="btn btn-style">Дэлгэрэнгүй</a>
                </div>
            </div>
            @endforeach

        </div>
        @include('frontend.rigthmenu')
    </div>
    <!-- pagination -->

    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                {{ $posts->links() }}
            </div>
            <div class="col-sm-12">
              <?php $footer_banner = App\Banners::where('banner_position', 'footer_banner')->first(); ?>
              @if(isset($footer_banner->url))
                <div class="banner">
                  <a href="{{$footer_banner->url}}">
                    <img src="{{$footer_banner->bannerpath}}" class="img-responsive center-block" alt="">
                  </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
@section('javascript')
<script>
  $(document).ready(function(){

  });
</script>
@endsection
