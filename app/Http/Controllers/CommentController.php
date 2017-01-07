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
      $comment->parent_id = '0';
      $comment->comment = $commenttext;
      $comment->postid = $postid;
      $comment->save();
      return back();
    }
    public function replyComment(Request $request){
      $username = $request->input('username');
      $commenttext = $request->input('comment');
      $postid = $request->input('postid');
      $replyid = $request->input('replyid');

      $comment = new Comments();
      $comment->username = $username;
      $comment->comment = $commenttext;
      $comment->postid = $postid;
      $comment->parent_id = $replyid;
      $comment->save();
      return back();
    }
}
