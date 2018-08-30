<?php

namespace App\Http\Controllers;

use App\Article;
use App\Comment;
use App\Forms\PostComment;
use App\Notifications\YouWereMentioned;
use App\User;
use Illuminate\Http\Request;

class CommentController extends Controller {

      public function __construct()
      {
            $this->middleware('auth');
      }

      /**
       * @param Article $article
       * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
       */

      public function index(Article $article)
      {
            return $article->comments()->paginate(5);
      }

      /**
       * @param Article     $article
       * @param PostComment $postComment
       * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Database\Eloquent\Model|\Illuminate\Http\Response
       */
      public function storeArticle(Article $article , PostComment $postComment)
      {
            return $article->comment([
                  'body' => request('body') ,
                  'user_id' => auth()->id()
            ])->load('user');
      }


      /**
       * Show the form for editing the specified resource.
       *
       * @param Comment $comment
       * @return \Illuminate\Http\Response
       */
      public function edit(Comment $comment)
      {
            return view("views.comments.edit" , compact("comment"));
      }

      /**
       * Update the specified resource in storage.
       *
       * @param Comment $comment
       * @return void
       */
      public function update(Comment $comment)
      {
            if (auth()->user()->id === $comment->user_id)
            {
                  $this->validate(request() , [
                        'body' => 'required|spamfree'
                  ]);

                  $comment->body = request('body');
                  $comment->save();
            }
            session()->flash('error' , 'You are not owner of this comment!');
      }

      /**
       * Remove the specified resource from storage.
       *
       * @param Comment $comment
       * @return \Illuminate\Http\Response
       * @throws \Exception
       */
      public function destroy(Comment $comment)
      {
            if (auth()->user()->id === $comment->user_id)
            {
                  $comment->delete();

                  if (request()->expectsJson())
                  {
                        return response(['status' => 'Reply deleted']);
                  }
            }
            session()->flash('error' , 'You are not owner of this comment!');
            return redirect()->back();
      }
}
