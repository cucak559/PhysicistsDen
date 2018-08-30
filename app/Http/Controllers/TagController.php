<?php

namespace App\Http\Controllers;


use App\Article;
use Cviebrock\EloquentTaggable\Models\Tag;

class TagController extends Controller {
      /**
       * @param Tag $tag
       * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
       */

      public function index(Tag $tag)
      {
            $ids = [0];

            foreach (auth()->user()->groups as $group)
            {
                  $ids[] = $group->id;
            }

            $articles = Article::withAllTags($tag->name)
                  ->whereIn('group_id' , $ids)
                  ->paginate(10);

            $tag = $tag->name;

            return view('views.articles.articles' , compact('articles' , 'tag'));
      }
}
