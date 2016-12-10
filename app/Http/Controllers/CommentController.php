<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comments;
class CommentController extends Controller
{
    public function addComment(Request $request){
      $username = $request->input('username');
      $commenttext = $request->input('comment');
      $postid = $request->input('postid');

      $comment = new Comments();
      $comment->username = $username;
      $comment->comment = $commenttext;
      $comment->postid = $postid;
      $comment->save();
      return back();
    }
}
