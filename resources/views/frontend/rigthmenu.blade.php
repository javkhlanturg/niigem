<div class="col-md-4 col-sm-4 left-padding">



  <div class="tab-inner">
    <ul class="tabs">
      <li><a href="#">ШИНЭ</a></li>
      <li><a href="#">ИХ ҮЗСЭН</a></li>
    </ul>
    <hr>
    <!-- tabs -->
    <div class="tab_content">
      <div class="tab-item-inner" id="topnews">

      </div>
      <!-- / tab item -->
      <div class="tab-item-inner" id="mostviewed">

      </div>
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
  <div class="poll_content">

  </div>
</div>
