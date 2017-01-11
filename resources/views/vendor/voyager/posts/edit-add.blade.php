@extends('voyager::master')

@section('css')
<link rel="stylesheet" href="{{ config('voyager.assets_path') }}/css/media/media.css"/>
<link rel="stylesheet" type="text/css" href="{{ config('voyager.assets_path') }}/js/select2/select2.min.css">
<link rel="stylesheet" href="{{ config('voyager.assets_path') }}/css/media/dropzone.css"/>
    <style>
        .panel .mce-panel {
            border-left-color: #fff;
            border-right-color: #fff;
        }

        .panel .mce-toolbar,
        .panel .mce-statusbar {
            padding-left: 20px;
        }

        .panel .mce-edit-area,
        .panel .mce-edit-area iframe,
        .panel .mce-edit-area iframe html {
            padding: 0 10px;
            min-height: 350px;
        }

        .mce-content-body {
            color: #555;
            font-size: 14px;
        }

        .panel.is-fullscreen .mce-statusbar {
            position: absolute;
            bottom: 0;
            width: 100%;
            z-index: 200000;
        }

        .panel.is-fullscreen .mce-tinymce {
            height:100%;
        }

        .panel.is-fullscreen .mce-edit-area,
        .panel.is-fullscreen .mce-edit-area iframe,
        .panel.is-fullscreen .mce-edit-area iframe html {
            height: 100%;
            position: absolute;
            width: 99%;
            overflow-y: scroll;
            overflow-x: hidden;
            min-height: 100%;
        }
    </style>
@stop

@section('page_header')
    <h1 class="page-title">
        <i class="{{ $dataType->icon }}"></i> {{ $dataType->display_name_singular }} @if(isset($dataTypeContent->id)){{ 'засах' }}@else{{ 'шинэ' }}@endif
    </h1>
@stop

@section('content')
    <div class="page-content container-fluid">
        <form role="form" action="@if(isset($dataTypeContent->id)){{ route('voyager.posts.update', $dataTypeContent->id) }}@else{{ route('voyager.posts.store') }}@endif" method="POST" enctype="multipart/form-data">
            <!-- PUT Method if we are editing -->
            @if(isset($dataTypeContent->id))
                {{ method_field("PUT") }}
            @endif
            {{ csrf_field() }}

            <div class="row">
                <div class="col-md-8">
                    <!-- ### TITLE ### -->
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <i class="voyager-character"></i> Мэдээний гарчиг
                                <span class="panel-desc"> Таны мэдээний гарчиг байна</span>
                            </h3>
                            <div class="panel-actions">
                                <a class="panel-action voyager-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <input type="text" class="form-control" name="title" placeholder="Title" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif">
                        </div>
                    </div>

                    <!-- ### CONTENT ### -->
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="icon wb-book"></i> Мэдээний агуулга</h3>
                            <div class="panel-actions">
                                <a class="panel-action voyager-resize-full" data-toggle="panel-fullscreen" aria-hidden="true"></a>
                            </div>
                        </div>
                        <textarea class="richTextBox" name="body" style="border:0px;">@if(isset($dataTypeContent->body)){{ $dataTypeContent->body }}@endif</textarea>
                    </div><!-- .panel -->

                    <!-- ### EXCERPT ### -->
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Excerpt <small>мэдээний тухай жижиг тайлбар</small></h3>
                            <div class="panel-actions">
                                <a class="panel-action voyager-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>
                            </div>
                        </div>
                        <div class="panel-body">
                          <textarea class="form-control" name="excerpt">@if (isset($dataTypeContent->excerpt)){{ $dataTypeContent->excerpt }}@endif</textarea>
                        </div>
                    </div>

                    <!-- ### IMAGE ### -->
                    <div class="panel panel-bordered panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title"><div class="checkbox"> <label> <input type="checkbox" name="featured" @if(isset($dataTypeContent->featured) && $dataTypeContent->featured){{ 'checked="checked"' }}@endif > Фото мэдээ оруулах  </div> </h3>
                            <div class="panel-actions">
                                <a class="panel-action voyager-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>
                            </div>
                        </div>
                        <div class="panel-body">
                          <div id="filemanager">
                            <div class="breadcrumb-container">
                                <ol class="breadcrumb filemanager">
                                    <li data-folder="/" data-index="0"><span class="arrow"></span><strong>Мэдиа
                                            сан</strong></li>
                                    <template v-for="folder in folders">
                                        <li data-folder="@{{folder}}" data-index="@{{ $index+1 }}"><span
                                                    class="arrow"></span>@{{ folder }}</li>
                                    </template>
                                </ol>

                                <div class="toggle"><span>Хаах</span><i class="voyager-double-right"></i></div>
                            </div>

                            <ul id="files">

                              <li v-for="file in files.items">
                                  <div class="file_link" data-folder="@{{file.name}}" data-index="@{{ $index }}">
                                      <div class="link_icon">
                                          <template v-if="file.type.includes('image')">
                                              <div class="img_icon"
                                                   style="background-size: cover; background-image: url(@{{ encodeURI(file.path) }}); background-repeat:no-repeat; background-position:center center;display:inline-block; width:100%; height:100%;"></div>
                                          </template>
                                          <template v-if="file.type.includes('video')">
                                              <i class="icon voyager-video"></i>
                                          </template>
                                          <template v-if="file.type.includes('audio')">
                                              <i class="icon voyager-music"></i>
                                          </template>
                                          <template v-if="file.type == 'folder'">
                                              <i class="icon voyager-folder"></i>
                                          </template>
                                          <template
                                                  v-if="file.type != 'folder' && !file.type.includes('image') && !file.type.includes('video') && !file.type.includes('audio')">
                                              <i class="icon voyager-file-text"></i>
                                          </template>

                                      </div>
                                      <div class="details @{{ file.type }}"><h4>@{{ file.name }}</h4>
                                          <small>
                                              <template v-if="file.type == 'folder'">
                                              <!--span class="num_items">@{{ file.items }} file(s)</span-->
                                              </template>
                                              <template v-else>
                                                  <input type="checkbox" id="@{{ file.name}}" checked="@{{ file.checked}}" name="sliders[]" value="@{{ file.path }}:::@{{files.path}}:::@{{ file.name}}">
                                              </template>
                                          </small>
                                      </div>
                                  </div>
                              </li>

                            </ul>

                            <div id="file_loader">
                                <div id="file_loader_inner">
                                    <div class="icon voyager-helm"></div>
                                </div>
                                <p>Таны мэдиа файлуудыг ачааллаж байна</p>
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <!-- ### DETAILS ### -->
                    <div class="panel panel panel-bordered panel-warning">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="icon wb-clipboard"></i> Мэдээний дитэйл</h3>
                            <div class="panel-actions">
                                <a class="panel-action voyager-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>
                            </div>
                        </div>
                        <div class="panel-body">

                            <div class="form-group">
                                <label for="name">Мэдээний төлөв</label>
                                <select class="form-control" name="status">
                                    <option value="PUBLISHED" @if(isset($dataTypeContent->status) && $dataTypeContent->status == 'PUBLISHED'){{ 'selected="selected"' }}@endif>нийтлэх</option>
                                    <option value="DRAFT" @if(isset($dataTypeContent->status) && $dataTypeContent->status == 'DRAFT'){{ 'selected="selected"' }}@endif>драфт</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">Мэдээний категори</label>
                                <select class="form-control" name="category_id">
                                    @foreach(TCG\Voyager\Models\Category::all() as $category)
                                        <option value="{{ $category->id }}" @if(isset($dataTypeContent->category_id) && $dataTypeContent->category_id == $category->id){{ 'selected="selected"' }}@endif>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- ### IMAGE ### -->
                    <div class="panel panel-bordered panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="icon wb-image"></i> Нүүрэнд харагдах зураг</h3>
                            <div class="panel-actions">
                                <a class="panel-action voyager-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>
                            </div>
                        </div>
                        <div class="panel-body">
                            @if(isset($dataTypeContent->image))
                                <img src="{{ Voyager::image( $dataTypeContent->image ) }}" style="width:100%" />
                            @endif
                            <input type="file" name="image">
                        </div>
                    </div>

                    <!-- ### SEO CONTENT ### -->
                    <div class="panel panel-bordered panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="icon wb-search"></i> SEO Content</h3>
                            <div class="panel-actions">
                                <a class="panel-action voyager-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label for="name">Meta Description</label>
                                <textarea class="form-control" name="meta_description">@if(isset($dataTypeContent->meta_description)){{ $dataTypeContent->meta_description }}@endif</textarea>
                            </div>
                            <div class="form-group">
                                <label for="name">Meta Keywords</label>
                                <textarea class="form-control" name="meta_keywords">@if(isset($dataTypeContent->meta_keywords)){{ $dataTypeContent->meta_keywords }}@endif</textarea>
                            </div>
                            <div class="form-group">
                                <label for="name">SEO Title</label>
                                <input type="text" class="form-control" name="seo_title" placeholder="SEO Title" value="@if(isset($dataTypeContent->seo_title)){{ $dataTypeContent->seo_title }}@endif">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary pull-right">
                @if(isset($dataTypeContent->id)){{ 'Мэдээ хадгалах' }}@else<?= '<i class="icon wb-plus-circle"></i> Мэдээ бүртгэх'; ?>@endif
            </button>
        </form>

        <iframe id="form_target" name="form_target" style="display:none"></iframe>
        <form id="my_form" action="{{ route('voyager.upload') }}" target="form_target" method="post" enctype="multipart/form-data" style="width:0px;height:0;overflow:hidden">
            {{ csrf_field() }}
            <input name="image" id="upload_file" type="file" onchange="$('#my_form').submit();this.value='';">
            <input type="hidden" name="type_slug" id="type_slug" value="{{ $dataType->slug }}">
        </form>
    </div>
@stop

@section('javascript')
  <script src="{{ config('voyager.assets_path') }}/js/select2/select2.min.js"></script>
  <script src="{{ config('voyager.assets_path') }}/js/media/dropzone.js"></script>
    <script src="{{ config('voyager.assets_path') }}/lib/js/tinymce/tinymce.min.js"></script>
    <script src="{{ config('voyager.assets_path') }}/js/voyager_tinymce.js"></script>
    <script type="text/javascript">
    var manager = new Vue({
      el: '#filemanager',
      data: {
          files: '',
          folders: [],
          selected_file: '',
          directories: [],
      },
    });


    CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    var VoyagerMedia = function(o){
      var defaults = {
        baseUrl: "/slider"
      };
      var options = $.extend(true, defaults, o);
      this.init = function(){
        @if(isset($dataTypeContent->featured) and $dataTypeContent->id)
        <?php $sd = App\PostImage::where('post_id', $dataTypeContent->id)->first();
        ?>
          @if($sd)
          <?php $nm = explode('/', substr( $sd->public_path, 7 ));
          ?>
            @for($i=0; $i < sizeof($nm); $i++)
              @if($nm[$i])
                manager.folders.push( "{{$nm[$i]}}" );
              @endif
            @endfor
              getFiles(manager.folders);
          @else
              getFiles('/');
          @endif
        @else
        getFiles('/');
        @endif

        $('#files').on("dblclick", "li .file_link", function(){
          if (! $(this).children('.details').hasClass('folder')) {
            return false;
          }
          manager.folders.push( $(this).data('folder') );
          getFiles(manager.folders);
        });

        $('#files').on("click", "li", function(e){
          var clicked = e.target;
          if(!$(clicked).hasClass('file_link')){
            clicked = $(e.target).closest('.file_link');
          }
          setCurrentSelected(clicked);
        });

        $('.breadcrumb').on("click", "li", function(){
          var index = $(this).data('index');
          manager.folders = manager.folders.splice(0, index);
          getFiles(manager.folders);
        });

        $('.breadcrumb-container .toggle').click(function(){
          $('.flex #right').toggle();
          var toggle_text = $('.breadcrumb-container .toggle span').text();
          $('.breadcrumb-container .toggle span').text(toggle_text == "Close" ? "Open" : "Close");
          $('.breadcrumb-container .toggle .icon').toggleClass('fa-toggle-right').toggleClass('fa-toggle-left');
        });

        //********** Add Keypress Functionality **********//
        $(document).keydown(function(e) {
          var curSelected = $('#files li .selected').data('index');
          // left key
          if( (e.which == 37 || e.which == 38) && parseInt(curSelected)) {
            newSelected = parseInt(curSelected)-1;
            setCurrentSelected( $('*[data-index="'+ newSelected + '"]') );
          }
          // right key
          if( (e.which == 39 || e.which == 40) && parseInt(curSelected) < manager.files.items.length-1 ) {
            newSelected = parseInt(curSelected)+1;
            setCurrentSelected( $('*[data-index="'+ newSelected + '"]') );
          }
          // enter key
          if(e.which == 13) {
            if (!$('#new_folder_modal').is(':visible') && !$('#move_file_modal').is(':visible') && !$('#confirm_delete_modal').is(':visible') ) {
              manager.folders.push( $('#files li .selected').data('folder') );
              getFiles(manager.folders);
            }
            if($('#confirm_delete_modal').is(':visible')){
              $('#confirm_delete').trigger('click');
            }
          }
        });
        //********** End Keypress Functionality **********//

        manager.$watch('files', function (newVal, oldVal) {
          setCurrentSelected( $('*[data-index="0"]') );
          $('#filemanager #content #files').hide();
          $('#filemanager #content #files').fadeIn('fast');
          $('#filemanager .loader').fadeOut(function(){

            $('#filemanager #content').fadeIn();
          });

          if(newVal.items.length < 1){
            $('#no_files').show();
          } else {
            $('#no_files').hide();
          }
        });

        manager.$watch('directories', function (newVal, oldVal) {
          if($("#move_folder_dropdown").select2()){
            $("#move_folder_dropdown").select2('destroy');
          }
          $("#move_folder_dropdown").select2();
        });

        manager.$watch('selected_file', function (newVal, oldVal) {
          if(typeof(newVal) == 'undefined'){
            $('.right_details').hide();
            $('.right_none_selected').show();
            $('#move').attr('disabled', true);
            $('#delete').attr('disabled', true);
          } else {
            $('.right_details').show();
            $('.right_none_selected').hide();
            $('#move').removeAttr("disabled");
            $('#delete').removeAttr("disabled");
          }
        });

        function getFiles(folders){
          if(folders != '/'){
            var folder_location = '/' + folders.join('/');
          } else {
            var folder_location = '/';
          }
          $('#file_loader').fadeIn();
          $.post(options.baseUrl+'/action', { folder:folder_location, _token: CSRF_TOKEN,@if(isset($dataTypeContent->featured) and $dataTypeContent->id) post_id:{{$dataTypeContent->id}}, @endif _token: CSRF_TOKEN }, function(data) {
            $('#file_loader').hide();
            manager.files = data;
            for(var i=0; i < manager.files.items.length; i++){
              if(typeof(manager.files.items[i].size) != undefined){
                manager.files.items[i].size = bytesToSize(manager.files.items[i].size);
              }
            }
          });

          // Add the latest files to the folder dropdown
          var all_folders = '';
          $.post(options.baseUrl+'/directories', { folder_location:manager.folders, _token: CSRF_TOKEN }, function(data){
            manager.directories = data;
          });

        }

        function setCurrentSelected(cur){
          $('#files li .selected').removeClass('selected');
          $(cur).addClass('selected');
          manager.selected_file = manager.files.items[$(cur).data('index')];
        }

        function bytesToSize(bytes) {
          var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
          if (bytes == 0) return '0 Bytes';
          var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
          return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
        }
      }
    };

    </script>
    <script type="text/javascript">
    var media = new VoyagerMedia();
    $(function () {
        media.init();
    });
    </script>
@stop
