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

      <div class="col-sm-4">
        <?php $i = 1; foreach($videos as $video): ?>
        <?php if($i%2 === 1): ?>
              <div class="post-style1">
                  <div class="post-wrapper wow fadeIn" data-wow-duration="1s">
                      <!-- post image -->

                      <a href="/{{$video->category->slug}}/{{$video->id}}" class="video-img-icon">
                        <i class="fa fa-play"></i>
                        @if($video->image and file_exists(public_path().$video->image))
                        <img src="{{str_replace('.', '-medium.',$video->image)}}" style="max-width:326px;height: 179px;object-fit: cover;" alt="">
                        @else
                        <img src="/assets/images/placeholder.png" style="max-width:200px;height: 180px;object-fit: cover;" alt="">
                        @endif
                      </a>
                  </div>
                  <!-- post title -->
                  <h4><a href="/{{$video->category->slug}}/{{$video->id}}">{{str_limit($video->title, 60)}} </a></h4>

              </div>
            <?php endif; ?>
          <?php $i++; endforeach; ?>
          </div>


          <div class="col-sm-4">
            <?php $i = 1; foreach($videos as $video): ?>
            <?php if($i%2 == 0): ?>
                <div class="post-style1">
                    <div class="post-wrapper wow fadeIn" data-wow-duration="1s">
                        <!-- post image -->
                        <a href="/{{$video->category->slug}}/{{$video->id}}" class="video-img-icon">
                          <i class="fa fa-play"></i>
                          @if($video->image and file_exists(public_path().$video->image))
                          <img src="{{str_replace('.', '-medium.',$video->image)}}" style="max-width:326px;height: 179px;object-fit: cover;" alt="">
                          @else
                          <img src="/assets/images/placeholder.png" style="max-width:200px;height: 180px;object-fit: cover;" alt="">
                          @endif
                        </a>
                    </div>
                    <!-- post title -->
                    <h4><a href="/{{$video->category->slug}}/{{$video->id}}">{{str_limit($video->title, 60)}} </a></h4>

                </div>
              <?php endif; ?>
            <?php $i++; endforeach; ?>
            </div>

        @include('frontend.rigthmenu')
    </div>
    <!-- pagination -->
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
              {{ $videos->links() }}
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
