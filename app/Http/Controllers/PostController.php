<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function postList($slug){
      $menu = \TCG\Voyager\Models\MenuItem::where('menu_id', 2)->where('url', "/".$slug)->first();
      $posts = \TCG\Voyager\Models\Category::where('slug', $slug)->first()->posts();
      return view("frontend.postlist", ['posts'=>$posts, 'menu'=>$menu]);
    }
}
