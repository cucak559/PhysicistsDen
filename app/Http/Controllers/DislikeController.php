<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;

class DislikeController extends Controller {
      public function __construct()
      {
            $this->middleware('auth');
      }

      /**
       * Store a newly created resource in storage.
       *
       * @param  \Illuminate\Http\Request $request
       * @param Article                   $article
       * @return \Illuminate\Http\Response
       */
      public function store(Request $request , Article $article)
      {
            $article->dislike();
            return back();
      }
}
