<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
  public function index(){
    $top_news = \TCG\Voyager\Models\Category::where('id', '8')->get();
    return view('frontend.index')
    ->with('top_news',$top_news);
  }

}
