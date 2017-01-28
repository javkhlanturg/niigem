@foreach($posts as $news)
<div class="box-item wow fadeIn" data-wow-duration="1s">
  <div class="img-thumb">
    <a href="/{{$news->category->slug}}/{{$news->id}}" rel="bookmark">
      @if($news->image and file_exists(public_path().$news->image))
      <img class="entry-thumb" src="{{str_replace('.', '-small.',$news->image)}}" style="width:90px;height:80px;object-fit: cover;">
      @else
      <img class="entry-thumb" src="/assets/images/placeholder.png" style="width:90px;height:80px;object-fit: cover;">
      @endif
    </a>
  </div>
  <div class="item-details">
    <h3 class="td-module-title"><a href="/{{$news->category->slug}}/{{$news->id}}">{{$news->title}}</a></h3>
    <div class="post-editor-date">
      <!-- post date -->
      <div class="post-date">
        <i class="pe-7s-clock"></i> {{ date('Y.m.d', strtotime($news->created_at)) }}
      </div>
      <!-- post comment -->
      <div class="post-author-comment"><i class="pe-7s-comment"></i> {{$news->commentCount()}} </div>
    </div>
  </div>
</div>
@endforeach
