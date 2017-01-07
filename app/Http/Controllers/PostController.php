<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comments;
use Illuminate\Support\Facades\DB;
class PostController extends Controller
{
    public function postList($slug){
        $menu = \TCG\Voyager\Models\MenuItem::where('menu_id', 2)->where('url', "/".$slug)->first();
        $category = \TCG\Voyager\Models\Category::where('slug', $slug)->first();
        if(!$category){
          return view('frontend.404');
        }
        $posts = $category->posts()->paginate(3);
        $newss = \TCG\Voyager\Models\Post::orderBy('created_at', 'desc')->limit('3')->get();
        return view("frontend.postlist", ['posts'=>$posts, 'menu'=>$menu, 'newss'=>$newss]);
    }

    public function post($slug, $postid){
        $menu = \TCG\Voyager\Models\MenuItem::where('menu_id', 2)->where('url', "/".$slug)->first();
        $category = \TCG\Voyager\Models\Category::where('slug', $slug)->first();
        if(!$category){
          return view('frontend.404');
        }
        $post = $category->posts()->where('id', $postid)->first();
        if(!$post){
          return view('frontend.404');
        }
        $comments = DB::table('comments')->where('postid', $post->id)->where('parent_id','0')->get();
        foreach($comments as $c){
          $c->replies = DB::table('comments')->where('parent_id', $c->id)->get();
        }

        // $reply_comments = Comments::where('postid',$post->id)->where('parent_id',)->get();
        $newss = \TCG\Voyager\Models\Post::orderBy('created_at', 'desc')->limit('3')->get();
        return view('frontend.viewpost', ['post'=>$post, 'menu'=>$menu, 'comments'=>$comments, 'newss'=>$newss,'replies'=>$c->replies]);
    }
}
