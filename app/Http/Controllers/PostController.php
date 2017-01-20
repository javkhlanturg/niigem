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
  private $directory = '';

  public function __construct()
  {
      $this->filesystem = config('filesystems.default');
      if ($this->filesystem === 'local') {
          $this->directory = 'public';
      } elseif ($this->filesystem === 's3') {
          $this->directory = '';
      }
  }

    public function postList($slug){
        $menu = \TCG\Voyager\Models\MenuItem::where('menu_id', 2)->where('url', "/".$slug)->first();
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
        $newss = Post::orderBy('created_at', 'desc')->limit('3')->get();
        return view("frontend.postlist", ['posts'=>$posts, 'menu'=>$menu, 'newss'=>$newss]);
    }

    public function post($slug, $postid){
        $menu = \TCG\Voyager\Models\MenuItem::where('menu_id', 2)->where('url', "/".$slug)->first();
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

        // $reply_comments = Comments::where('postid',$post->id)->where('parent_id',)->get();
        $newss = \TCG\Voyager\Models\Post::orderBy('created_at', 'desc')->limit('3')->get();
        return view('frontend.viewpost', ['post'=>$post, 'menu'=>$menu, 'comments'=>$comments, 'newss'=>$newss]);
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
        $folder = $request->folder;
        if ($folder == '/') {
            $folder = '';
        }
        $dir = $this->directory.$folder;
        if($request->input('post_id')){
            $images = PostImage::where('post_id', $request->input('post_id'));
        }else{
          return response()->json([
              'name'          => 'files',
              'type'          => 'folder',
              'path'          => $dir,
              'folder'        => $folder,
              'items'         => $this->getFileOne($dir),
              'last_modified' => 'asdf',
          ]);
        }

        return response()->json([
            'name'          => 'files',
            'type'          => 'folder',
            'path'          => $dir,
            'folder'        => $folder,
            'items'         => $this->getFiles($dir, $images),
            'last_modified' => 'asdf',
        ]);
    }

    private function getFiles($dir, $images)
    {

        $files = [];
        $storageFiles = Storage::files($dir);
        $storageFolders = Storage::directories($dir);

        foreach ($storageFiles as $file) {
          $filename = strpos($file, '/') > 1 ? str_replace('/', '', strrchr($file, '/')) : $file;
          $check = starts_with($filename, 'thumb');
          if(!$check){
            $temp_image = clone $images;
            $temp = $temp_image->where('file_name',$filename);
              $files[] = [
                  'name'          => $filename,
                  'checked'       => sizeof($temp->first())>0,
                  'type'          => Storage::mimeType($file),
                  'path'          => Storage::disk(config('filesystem.default'))->url($file),
                  'size'          => Storage::size($file),
                  'last_modified' => Storage::lastModified($file),
              ];


              $temp = null;
          }
        }

        foreach ($storageFolders as $folder) {
            $files[] = [
                'name'          => strpos($folder, '/') > 1 ? str_replace('/', '', strrchr($folder, '/')) : $folder,
                'type'          => 'folder',
                'path'          => Storage::disk(config('filesystem.default'))->url($folder),
                'items'         => '',
                'last_modified' => '',
            ];
        }

        return $files;
    }

    private function getFileOne($dir)
    {

        $files = [];
        $storageFiles = Storage::files($dir);
        $storageFolders = Storage::directories($dir);

        foreach ($storageFiles as $file) {
          $filename = strpos($file, '/') > 1 ? str_replace('/', '', strrchr($file, '/')) : $file;
          $check = starts_with($filename, 'thumb');
          if(!$check){
            $files[] = [
                'name'          => strpos($file, '/') > 1 ? str_replace('/', '', strrchr($file, '/')) : $file,
                'checked'       => false,
                'type'          => Storage::mimeType($file),
                'path'          => Storage::disk(config('filesystem.default'))->url($file),
                'size'          => Storage::size($file),
                'last_modified' => Storage::lastModified($file),
            ];
          }

        }

        foreach ($storageFolders as $folder) {
            $files[] = [
                'name'          => strpos($folder, '/') > 1 ? str_replace('/', '', strrchr($folder, '/')) : $folder,
                'type'          => 'folder',
                'path'          => Storage::disk(config('filesystem.default'))->url($folder),
                'items'         => '',
                'last_modified' => '',
            ];
        }

        return $files;
    }


}
