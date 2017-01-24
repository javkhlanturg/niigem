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
            <a href="/{{$news->category['slug']}}/{{$news->id}}" rel="bookmark"><img class="entry-thumb" src="{{str_replace('.', '-small.',$news->image)}}" style="width:90px;height:80px;object-fit: cover;"></a>
          </div>
          <div class="item-details">
            <h6 class="sub-category-title bg-color-1">
              <a href="/{{$news->category['slug']}}/{{$news->id}}">{{$news->category['name']}}</a>
            </h6>
            <h3 class="td-module-title"><a href="/{{$news->category['slug']}}/{{$news->id}}">{{$news->title}}</a></h3>
            <div class="post-editor-date">
              <!-- post date -->
              <div class="post-date">
                <i class="pe-7s-clock"></i> {{ date('M d, Y', strtotime($news->created_at)) }}
              </div>
              <!-- post comment -->
              <div class="post-author-comment"><i class="pe-7s-comment"></i> {{$news->commentCount()}} </div>
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
    <?php $add_banner = App\Banners::where('id', 5)->first(); ?>
    <span class="add-title">- Сурталчилгаа -</span>
    <a href="{{$add_banner->url}}"><img src="{{$add_banner->bannerpath}}" class="img-responsive center-block" alt=""></a>
  </div>
  <!-- comments -->
  <div class="latest-comments-inner">
    <?php $comments = App\Comments::orderBy('created_at', 'desc')->limit(3)->get(); ?>
    <h3 class="category-headding ">Сүүлийн сэтгэгдэлүүд</h3>
    <div class="headding-border"></div>
    <!-- latest comment post -->
    @foreach($comments as $comment)
    <div class="post-style2 latest-com">
      <img src="\assets\images\avatar.jpg" alt="">
      <div class="latest-com-detail">
        <h5>{{$comment->username}}</h5>
        <p>{{str_limit($comment->comment, 20)}} </p>
      </div>
    </div>
    @endforeach
  </div>
</div>
