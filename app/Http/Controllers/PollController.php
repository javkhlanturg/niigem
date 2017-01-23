<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PollController extends Controller
{

    public function index()
   {
       return view('frontend.poll');
   }

   public function doPoll()
   {
   if ( ! $pollId = \Input::get('poll_id', FALSE) )
   {
     return FALSE;
   }

   $rules = array(
           'poll_id' => 'required',
           'answer' => 'required',
       );

   $validator = \Validator::make(
       \Input::all(),
       $rules
   );

   if ( ! $validator->fails() )
   {
     $poll = Poll::findOrFail($pollId);

     for ($i=1; $i <= 3; $i++) {
       if ( \Input::get('answer') == $poll->{'answer'.$i} )
       {
         $poll->{'answer'.$i.'_count'}++;
         $poll->save();
         break;
       }
     }

     if (\Request::ajax())
     {
         die(1);
     }
   }

   return \Redirect::to(\Input::get('return'));
   }
}
