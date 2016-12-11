<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
  public function index(){
    $top_news = \TCG\Voyager\Models\Post::where('category_id', '10')->get();
    $uls_turs =  \TCG\Voyager\Models\Post::where('category_id', '4')->limit('3')->get();
      $zasags =  \TCG\Voyager\Models\Post::where('category_id', '5')->limit('3')->get();
      $delhiis =  \TCG\Voyager\Models\Post::where('category_id', '7')->limit('3')->get();
      $videos =  \TCG\Voyager\Models\Post::where('category_id', '11')->limit('3')->get();
      $newss = \TCG\Voyager\Models\Post::orderBy('created_at', 'desc')->limit('3')->get();
      $footer_banner = \App\Banners::where('id', 4)->first();
    return view('frontend.index')
    ->with('top_news',$top_news)
    ->with('uls_turs',$uls_turs)
    ->with('zasags',$zasags)
    ->with('delhiis',$delhiis)
    ->with('footer_banner',$footer_banner)
    ->with('videos',$videos)
    ->with('newss',$newss);
  }

}
