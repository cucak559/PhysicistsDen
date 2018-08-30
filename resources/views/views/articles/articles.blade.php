@extends('layout')

@section('content')
       <div class="header text-center">
             @if ($tag)
                   <h5 class="header-whatshup">WHAT'S UP IN TAG</h5>
                  <h3 class="header-text">{{$tag}}</h3>

            @else
                   <h3 class="header-text">All Articles</h3>
                   <a href="/articles/create"><i class="fas fa-plus mb-3"></i>Add article</a>

             @endif

            <p>{{count(App\Article::all())}} {{str_plural('article',count(App\Article::all()))}}</p>
      </div>

      <div class="container py-2">

            @if (count($articles) === 0)
                  <div class="row">
                        <div class="col-md-12">
                              <div class="alert-danger">
                                    No articles... please add some.
                              </div>
                        </div>
                  </div>
            @else

                  @foreach ($articles as $article)
                        @include('partials.article')
                  @endforeach
            @endif

      <div class="row text-center">
            <div class="col-md-12 d-inline-block">
                    {{$articles->links()}}
            </div>
       </div>
  </div>
@endsection
