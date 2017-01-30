<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use App\PollQuestion;
use App\PollAnswer;
use Illuminate\Cookie\CookieJar;
use Illuminate\Routing\Redirector;

class PollController extends Controller
{
  private $app;

    /**
     * @var \Illuminate\Http\Request
     */
    private $request;

    public function __construct(Application $app, Request $request)
    {
        $this->app = $app;
        $this->request = $request;
    }

    public function index()
   {
     $path = $this->app->storagePath().DIRECTORY_SEPARATOR.'poll'.DIRECTORY_SEPARATOR.'disabled';

       $question = PollQuestion::latest()->first();

       $pollCookie = $this->request->cookie('poll');
       $votedPolls = $pollCookie ? explode(',', $pollCookie) : [];


       return view('frontend.poll')
       ->with([
           'voted' => $question && in_array($question->id, $votedPolls),
           'pollDisabled' => file_exists($path),
           'question' => $question,
       ]);
   }

   public function store(PollAnswer $answer, Request $request, Redirector $redirector, CookieJar $cookies)
  {

      $id = $request->input('id');
      $answer = $request->input('answer');
      $poll = PollAnswer::where('poll_question_id',$id)->where('id',$answer)->first();
      if($poll){
      $poll->votes = $poll->votes + 1;
    }
      $poll->save();

      return back();
  }
}
