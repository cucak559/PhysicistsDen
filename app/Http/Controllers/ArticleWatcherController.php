<?php

namespace App\Http\Controllers;

use App\Article;

class ArticleWatcherController extends Controller {

      public function store(Article $article)
      {
            $article->watch();
      }

      public function destroy(Article $article)
      {
            $article->unwatch();
      }
}
