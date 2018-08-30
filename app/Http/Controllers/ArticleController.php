<?php

namespace App\Http\Controllers;

use App\Topic;
use App\Article;
use App\Filters\ArticleFilters;
use Illuminate\Http\Request;
use App\Http\Requests\StoreArticle;

class ArticleController extends Controller {

      public function __construct()
      {
            $this->middleware('auth');
            $this->middleware('group')->except(['show' , 'edit' , 'update' , 'destroy']);
      }

      /**
       * Display a listing of the resource.
       *
       * @param int            $group
       * @param ArticleFilters $filters
       * @return \Illuminate\Http\Response
       */
      public function index(ArticleFilters $filters , $group = 0)
      {

            $articles = Article::latest()
                  ->where('group_id' , $group)
                  ->archive(request(['month' , 'year']))
                  ->filter($filters)
                  ->with(['topic' , 'user' , 'tags' , 'likes' , 'dislikes'])
                  ->paginate(10);

            if (request()->wantsJson())
            {
                  return $articles;
            }

            $tag = false;

            return view('views.articles.articles' , compact('articles' , 'tag' , 'group'));
      }

      public function archive()
      {
            $archives = Article::archives();

            return view('views.articles.archives' , compact('archives'));
      }

      /**
       * Show the form for creating a new resource.
       *
       * @param int $topic
       * @return \Illuminate\Http\Response
       */
      public function create($topic = 0)
      {
            $tags = Article::allTags();


            if ($topic === 0)
            {
                  $group_ids = [0];
                  $groups = auth()->user()->groups;

                  foreach ($groups as $group)
                  {
                        $group_ids[] = $group->id;
                  };

                  $topics = Topic::latest()
                        ->whereIn('group_id' , $group_ids)
                        ->get();
            } else
            {
                  $topics = null;
            }

            return view('views.articles.create' , compact('topic' , 'topics' , 'tags'));
      }

      /**
       * Store a newly created resource in storage.
       *
       * @param  \Illuminate\Http\Request $request
       * @param                           $topic
       * @param StoreArticle              $validation
       * @return \Illuminate\Http\Response
       */
      public function store(Request $request , $topic , StoreArticle $validation)
      {
            $article = new Article;

            if ($topic === "0")
            {
                  $topic = request('topic_id');
            }

            $topic = Topic::find($topic);

            if ($topic->group_id !== 0)
            {
                  $article->group_id = $topic->group_id;
            }

            $tags = explode(',' , $request->tags);

            $article->user_id = auth()->user()->id;
            $article->topic_id = $topic->id;
            $article->title = request('title');
            $article->description = request('description');
            $article->body = request('body');

            $article->save();

            $article->tag($tags);
            $article->save();

            session()->flash('message' , 'Article has been created');

            if ($topic->group_id === 0)
            {
                  return redirect('articles/all');
            }

            return redirect('articles/all/' . $topic->group_id);


      }

      /**
       * Display the specified resource.
       *
       * @param Article $article
       * @return \Illuminate\Http\Response
       * @throws \Exception
       */
      public function show(Article $article)
      {
            $article->views += 1;
            $article->save();

            auth()->user()->read($article);

            return view('views.articles.show' , compact('article'));
      }

      /**
       * Show the form for editing the specified resource.
       *
       * @param Article $article
       * @return \Illuminate\Http\Response
       */
      public function edit(Article $article)
      {
            if (auth()->user()->id === $article->user_id)
            {
                  $tags = Article::allTags();
                  $article = Article::with('tags')->findOrFail($article->id);
                  return view("views.articles.edit" , compact("article" , 'tags'));
            }

            session()->flash('error' , 'You are not owner of this article!');
            return redirect()->back();
      }

      /**
       * Update the specified resource in storage.
       *
       * @param  \Illuminate\Http\Request $request
       * @param Article                   $article
       * @param StoreArticle              $validation
       * @return \Illuminate\Http\Response
       */
      public function update(Request $request , Article $article , StoreArticle $validation)
      {
            if (auth()->user()->id === $article->user_id)
            {

                  $tags = explode(',' , $request->tags);

                  $article->title = request('title');
                  $article->description = request('description');
                  $article->body = request('body');
                  $article->save();


                  $article->retag($tags);
                  $article->save();

                  session()->flash('message' , 'Article successfully updated');

                  return redirect('articles/all');
            }
      }

      /**
       * Remove the specified resource from storage.
       *
       * @param Article $article
       * @return \Illuminate\Http\Response
       * @throws \Exception
       */
      public function destroy(Article $article)
      {

            if (auth()->user()->id === $article->user_id)
            {
                  $article->delete();

                  session()->flash('message' , 'Article successfully destroyed');
                  return redirect('articles/all');
            }

            session()->flash('error' , 'You are not owner of this article!');
            return redirect()->back();
      }

      public function search(Request $request)
      {
            $sear = request("search");
            $articles = Article::latest()
                  ->search($sear)
                  ->paginate(10);

            $tag = false;

            return view('views.articles.articles' , compact('articles' , 'tag'));
      }
}
