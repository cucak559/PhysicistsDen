<?php

namespace App\Http\Controllers;

use App\Favourite;
use App\Article;
use Illuminate\Http\Request;

class FavouriteController extends Controller {

      public function __construct()
      {
            $this->middleware('auth');
      }

      /**
       * Display a listing of the resource.
       *
       * @return \Illuminate\Http\Response
       */
      public function index()
      {
            $favourites = Favourite::latest()
                  ->where('user_id' , auth()->user()->id)
                  ->get();

            return view('views.favourites.index' , compact('favourites'));
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

            $article->favourite();

            if (request()->expectsJson())
            {
                  return response(['status' => 'Article has been added to favourites']);
            }

            return back();
      }

      /**
       * Remove the specified resource from storage.
       *
       * @param Article $article
       * @return void
       */
      public function destroy(Article $article)
      {
            $article->unfavorite();
      }
}
