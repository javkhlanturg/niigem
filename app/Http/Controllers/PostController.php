<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function postList($slug){
      $posts = \TCG\Voyager\Models\Category::where('slug', $slug)->posts();
      return view("frontend.postlist", ['posts'=>$posts]);
    }
}
