<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Swap;
use \TCG\Voyager\Models\Post;

class HomeController extends Controller
{
  public function index(){
    $top_news = \TCG\Voyager\Models\Post::where('category_id', '10')->orderBy('created_at', 'desc')->get();
    $uls_turs =  \TCG\Voyager\Models\Post::where('category_id', '4')->orderBy('created_at', 'desc')->limit('3')->get();
      $zasags =  \TCG\Voyager\Models\Post::where('category_id', '5')->orderBy('created_at', 'desc')->limit('3')->get();
      $delhiis =  \TCG\Voyager\Models\Post::where('category_id', '7')->orderBy('created_at', 'desc')->limit('3')->get();
      $videos =  \TCG\Voyager\Models\Post::where('category_id', '11')->orderBy('created_at', 'desc')->limit('3')->get();
      $newss = \TCG\Voyager\Models\Post::orderBy('created_at', 'desc')->limit('4')->get();
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

  public function action(Request $request){
    switch ($request->input('action')) {
      case 'weather': return $this->callWeather($request);
      case 'actionews':return $this->actionNews();

      default:
        # code...
        break;
    }
  }

  public function callWeather($request){
    //$yql_query_url = "http://tsag-agaar.gov.mn/forecast_xml/292";
    $yql_query_url = "http://tsag-agaar.gov.mn/nowweather/292";
    // Make call with cURL
    $session = curl_init($yql_query_url);
    curl_setopt($session, CURLOPT_RETURNTRANSFER,true);
    $xml = curl_exec($session);

    $DOM = new \DOMDocument();
    $DOM->loadHTML($xml);

    $xpath = new \DOMXPath($DOM);
    $someclass_elements = $xpath->query('//span[@class = "c show"]');
    $img = $DOM->getElementsByTagName('img');
    $description_load = $xpath->query('//span[@class = "temp-desc"]');
    $temp = $someclass_elements->item(0)->nodeValue;
    $description = $description_load->item(0)->nodeValue;

    $html = '<li><a href="#"> Улаанбаатар: </a> <span class="color-1"> '.$temp.' &#8451; </span> <img src="'."http://tsag-agaar.gov.mn".$img[1]->getAttribute("src").'" style="width: 16px;"></li>';

    return response()->json(array('html'=>$html));
    // Convert JSON to PHP object
    // $phpObj =  simplexml_load_string($xml);
     //$pp = $this->object2array($phpObj);
     //image - http://tsag-agaar.gov.mn/images/weather/20_n.png
     //$weather = $pp['forecast5day']['data']['weather'][0];
     //$html
     //<li><span class="color-1"><img src="/../assets/flag/usd.png" style='height: 16px;'/> USD:</span>УБ: ".$weather." </li>
  }

  public function actionNews(){
    $topnews = Post::where('status', 'PUBLISHED')->orderBy('created_at', 'desc')->limit('4')->get();
    $topnews_html = view('frontend.actionitem', ['posts'=>$topnews])->render();
    $mostviewed = Post::where('status', 'PUBLISHED')->orderBy('viewcount', 'desc')->limit('4')->get();
    $mostviewed_html = view('frontend.actionitem', ['posts'=>$mostviewed])->render();
    return response()->json(array('mostviewed'=>$mostviewed_html, 'topnews'=>$topnews_html));
  }

  function object2array($object) { return @json_decode(@json_encode($object),1); }

}
