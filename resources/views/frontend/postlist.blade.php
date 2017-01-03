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
                <a href="#"><img src="/storage/app/public/{{$item->image}}" style="max-width:250px" alt=""></a>
                <div class="post-style2-detail">
                    <h3><a href="{{$menu->url}}/{{$item->id}}" title="">{{$item->title}}</a></h3>
                    <div class="date">
                        <ul>
                            <li><img src="\assets\images\comment-01.jpg" class="img-responsive" alt=""></li>
                            <li>By <a title="" href="#"><span>Naeem Khan</span></a> --</li>
                            <li><a title="" href="#">{{date('Y.m.d', strtotime($item->created_at))}}</a> --</li>
                            <li><a title="" href="#"><span>275 Comments</span></a></li>
                        </ul>
                    </div>
                    <p>{{$item->excerpt}}</p>
                    <a href="{{$menu->url}}/{{$item->id}}" class="btn btn-style">Дэлгэрэнгүй</a>
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
              <?php $footer_banner = App\Banners::where('id', 4)->first(); ?>
                <div class="banner">
                  <a href="{{$footer_banner->url}}">
                    <img src="/storage/{{$footer_banner->bannerpath}}" class="img-responsive center-block" alt="">
                  </a>
                </div>
            </div>
        </div>
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
