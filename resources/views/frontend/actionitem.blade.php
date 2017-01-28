@foreach($posts as $news)
<div class="box-item wow fadeIn" data-wow-duration="1s">
  <div class="img-thumb">
    <a href="/{{$news->category->slug}}/{{$news->id}}" rel="bookmark"><img class="entry-thumb" src="{{str_replace('.', '-small.',$news->image)}}" style="width:90px;height:80px;object-fit: cover;"></a>
  </div>
  <div class="item-details">
    <h6 class="sub-category-title bg-color-1">
      <a href="/{{$news->category->slug}}">{{$news->category->name}}</a>
    </h6>
    <h3 class="td-module-title"><a href="/{{$news->category->slug}}/{{$news->id}}">{{$news->title}}</a></h3>
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
