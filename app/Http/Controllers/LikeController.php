<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;

class LikeController extends Controller {
      public function __construct()
      {
            $this->middleware('auth');
      }

      /**
       * Display a listing of the resource.
       *
       * @return \Illuminate\Http\Response
       */

      /**
       * Store a newly created resource in storage.
       *
       * @param  \Illuminate\Http\Request $request
       * @return \Illuminate\Http\Response
       */
      public function store(Request $request , Article $article)
      {
            $article->like();
            return back();
      }
}
