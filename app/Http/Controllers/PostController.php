<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comments;
class PostController extends Controller
{
    public function postList($slug){
      $menu = \TCG\Voyager\Models\MenuItem::where('menu_id', 2)->where('url', "/".$slug)->first();
      $posts = \TCG\Voyager\Models\Category::where('slug', $slug)->first()->posts()->paginate(3);
      return view("frontend.postlist", ['posts'=>$posts, 'menu'=>$menu]);
    }

    public function post($slug, $postid){
        $menu = \TCG\Voyager\Models\MenuItem::where('menu_id', 2)->where('url', "/".$slug)->first();
        $post = \TCG\Voyager\Models\Category::where('slug', $slug)->first()->posts()->where('id', $postid)->first();
        $comments = Comments::where('postid', $post->id)->get();
        return view('frontend.viewpost', ['post'=>$post, 'menu'=>$menu, 'comments'=>$comments]);
    }
}
