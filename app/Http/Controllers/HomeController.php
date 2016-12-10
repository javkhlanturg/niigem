<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
  public function index(){
    $top_news = TCG\Voyager\Models\MenuItem::where('menu_id', 3)->limit('5')->get();
    return view('frontend.index')
    ->with('top_news',$top_news);
  }

}
