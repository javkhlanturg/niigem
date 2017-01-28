<div class="sub-footer">

    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <p><a href="" class="color-1">Niigem.Net</a>  2016</p>
                <div class="social">
                    <ul>
                      @if(Voyager::setting('facebook'))
                        <li><a href="{{Voyager::setting('facebook')}}" class="facebook"><i class="fa  fa-facebook"></i> </a></li>
                      @endif
                      @if(Voyager::setting('twitter'))
                        <li><a href="{{Voyager::setting('twitter')}}" class="twitter"><i class="fa  fa-twitter"></i></a></li>
                      @endif
                      @if(Voyager::setting('googleplus'))
                        <li><a href="{{Voyager::setting('googleplus')}}" class="google"><i class="fa  fa-google-plus"></i></a></li>
                      @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
