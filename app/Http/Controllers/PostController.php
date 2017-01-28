<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comments;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\PostImage;
use App\PostCategories;
use \TCG\Voyager\Models\Post;
class PostController extends Controller
{
  /** @var string */
  private $filesystem;

  /** @var string */
  private $directory = DIRECTORY_SEPARATOR.'media';

    public function postList($slug){
        $category = \TCG\Voyager\Models\Category::where('slug', $slug)->first();
        if(!$category){
          return view('frontend.404');
        }


        $post_ids = PostCategories::where("cat_id", $category->id)->get();
        $ids = array();
        foreach($post_ids as $id){
          array_push($ids, $id->post_id);
        }
        $posts = Post::where('status', '=', 'PUBLISHED')->where("category_id",'=', $category->id)->orWhereIn('id', $ids)->where('status', '=', 'PUBLISHED')
            ->orderBy('created_at', 'DESC')->paginate(6);
        return view("frontend.postlist", ['posts'=>$posts]);
    }

    public function post($slug, $postid){
        $category = \TCG\Voyager\Models\Category::where('slug', $slug)->first();
        if(!$category){
          return view('frontend.404');
        }
        $post = Post::where('id', $postid)->first();
        if(!$post){
          return view('frontend.404');
        }
        $comments = DB::table('comments')->where('postid', $post->id)->where('parent_id','0')->get();
        if(sizeof($comments) > 0 ){
          foreach($comments as $c){
            $c->replies = DB::table('comments')->where('parent_id', $c->id)->get();
          }
        }
        return view('frontend.viewpost', ['post'=>$post, 'comments'=>$comments]);
    }

    public function reportList(Request $request, $userid){
        $posts = Post::where('author_id', $userid)->where('status', 'PUBLISHED')->orderBy('created_at', 'desc')->paginate(6);
        return view("frontend.postlist", ['posts'=>$posts]);
    }

    public function get_all_dirs(Request $request)
    {
        $folderLocation = $request->folder_location;

        if (is_array($folderLocation)) {
            $folderLocation = rtrim(implode('/', $folderLocation), '/');
        }

        $location = "{$this->directory}/{$folderLocation}";

        return response()->json(
            str_replace($location, '', Storage::directories($location))
        );
    }

    public function sliders(Request $request)
    {
        $dir = $this->directory.$request->folder;
        if($request->input('post_id')){
            $images = PostImage::where('post_id', $request->input('post_id'));
        }else{
          return response()->json([
              'name'          => 'files',
              'type'          => 'folder',
              'path'          => $request->folder,
              'items'         => $this->getFileOne($dir),
              'last_modified' => 'asdf',
          ]);
        }

        return response()->json([
            'name'          => 'files',
            'type'          => 'folder',
            'path'          => $request->folder,
            'items'         => $this->getFiles($dir, $images),
            'last_modified' => 'asdf',
        ]);
    }

    private function getFiles($dir, $images)
    {

        $files = [];
        $fullPath = str_finish(public_path().$dir, DIRECTORY_SEPARATOR);
        $_files = array_diff(scandir($fullPath), array('.', '..'));
        $storageFolders = Storage::directories($dir);

        foreach ($_files as $file) {
          $filename = strpos($file, '/') > 1 ? str_replace('/', '', strrchr($file, '/')) : $file;
          $check = starts_with($filename, 'thumb');
          if(!$check){
            if(file_exists($fullPath.$file) and mime_content_type($fullPath.$file) !== 'directory'){
            $temp_image = clone $images;
            $temp = $temp_image->where('file_name',$filename);
              $files[] = [
                  'name'          => $filename,
                  'checked'       => sizeof($temp->first())>0,
                  'type'          => mime_content_type($fullPath.$file),
                  'path'          => str_finish($dir, DIRECTORY_SEPARATOR).$file,
                  'size'          => filesize($fullPath.$file),
                  'last_modified' => date("Y.m.d H:i:s.",filemtime($fullPath.$file)),
              ];

              $temp = null;
            }
          }
        }

        foreach ($_files as $folder) {
          if(file_exists($fullPath.$file) and mime_content_type($fullPath.$folder) === 'directory'){
            $files[] = [
                'name'          => strpos($folder, '/') > 1 ? str_replace('/', '', strrchr($folder, '/')) : $folder,
                'type'          => 'folder',
                'path'          => Storage::disk(config('filesystem.default'))->url($folder),
                'items'         => '',
                'last_modified' => '',
            ];
          }
        }

        return $files;
    }

    private function getFileOne($dir)
    {

      $files = [];
      $fullPath = str_finish(public_path().$dir, DIRECTORY_SEPARATOR);
      $_files = array_diff(scandir($fullPath), array('.', '..'));

      foreach ($_files as $file) {
        $filename = strpos($file, '/') > 1 ? str_replace('/', '', strrchr($file, '/')) : $file;
        $check = starts_with($filename, 'thumb');
        if(!$check){
          if(file_exists($fullPath.$file) and mime_content_type($fullPath.$file) !== 'directory'){
            $files[] = [
                'name'          => $filename,
                'checked'       => false,
                'type'          => mime_content_type($fullPath.$file),
                'path'          => str_finish($dir, DIRECTORY_SEPARATOR).$file,
                'size'          => filesize($fullPath.$file),
                'last_modified' => date("Y.m.d H:i:s.",filemtime($fullPath.$file)),
            ];

            $temp = null;
          }
        }
      }

      foreach ($_files as $folder) {
        if(file_exists($fullPath.$file) and mime_content_type($fullPath.$folder) === 'directory'){
          $files[] = [
              'name'          => strpos($folder, '/') > 1 ? str_replace('/', '', strrchr($folder, '/')) : $folder,
              'type'          => 'folder',
              'path'          => Storage::disk(config('filesystem.default'))->url($folder),
              'items'         => '',
              'last_modified' => '',
          ];
        }
      }

      return $files;
    }


}
