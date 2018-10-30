@extends('layout')

@section('content')
    <div class="header text-center">
        <h5 class="header-whatshup">WHAT'S UP IN</h5>
        <h3 class="header-text">{{ $topic->title }}</h3>

        <a href="/articles/create/{{$topic->id}}"><i class="fas fa-plus mb-3"></i>Add Article</a>

        @if (count($topic->articles) > 0)
            <p>{{$topic->articles()->count()}} article(s)</p>
        @else
            <p> No article</p>
        @endif
    </div>


    <div class="container">
        @foreach ($topic->articles as $article)
            <div class="row">
                <div class="col-md-12">

                    <div class="card article-card mb-4">
                        <div class="row">
                            <div class="col-auto">
                                <img src="//placehold.it/200" class="img-fluid" alt="">
                            </div>

                            <div class="col">
                                <div class="card-block px-2">
                                    <h4 class="card-title article-topic">
                                        <a href="/{{$article->topic->id}}/show">
                                            {{ $article->topic->title }}
                                        </a>
                                    </h4>

                                    <h2 class="card-title article-name">
                                        <a class="article" href="/articles/show/{{ $article->id }}">
                                            {{ $article->title }}
                                        </a>
                                    </h2>

                                    <div>


                                        <a href="/user/{{$article->user->id}}" class="card-text article-owner">
                                            <em class="owner-by mr-1">By</em>
                                            <span class="owner-name">{{ $article->user->name }}</span>
                                        </a>


                                        <span> -</span>
                                        <span>
                                                                        <i class="fas fa-eye"></i> {{$article->views}}
                                                                  </span>

                                        <span> | <i class="far fa-thumbs-up"></i>{{count($article->likes)}}
                                                                  </span>

                                        <span> | <i class="far fa-thumbs-down"></i>{{count($article->dislikes)}}</span>

                                    </div>


                                    <p class="card-text article-description mt-2">
                                        {{ $article->description }}
                                    </p>

                                    <p>
                                        Tags:
                                        @foreach ($article->tags as $tag)
                                            <a href="/articles/bytag/{{ $tag->tag_id }}"><span>{{ $tag->name}}</span></a>
                                        @endforeach
                                    </p>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach


    </div>
    </div>
@endsection
