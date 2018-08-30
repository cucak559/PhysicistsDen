@extends('layout')

@section('content')
    <article-view inline-template v-cloak>
        <div>
            <div class="header text-center">
                <div class="container">

                    <h6 class="topic-title"><a href="/{{ $article->topic->id }}/show">{{ $article->topic->title }}</a>
                    </h6>
                    <h3 class="header-text">{{ $article->title }}</h3>


                    <div class="row">
                        <div class="col-md-12">
                            <p>{{ $article->description }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">

                    <div class="col-md-2 article-author">
                        <img class="rounded-circle center"
                             src="http://theadvertplace.com/wp-content/themes/classified/img/placeholder/blogpost-placeholder-100x100.png">
                        <a href="/user/{{$article->user->id}}">
                            <p class="article-username text-center">{{$article->user->name}}</p>
                        </a>
                        <hr>
                        <p class="text-center article-date">{{$article->created_at->format('m/d/Y')}}</p>
                        <hr>

                        <div class="text-center">
                            @foreach ($article->tags as $tag)
                                <a class="article-tag" href="/articles/bytag/{{ $tag->tag_id }}">
                                    <span>{{$tag->name}}</span>
                                </a>
                            @endforeach
                        </div>

                        <hr>
                        <div class="text-center">
                            <div class="article-crud-buttons">

                                <watch-button :active="{{ json_encode($article->isWatched) }}"></watch-button>

                                <span>
                                                      <a href="/articles/edit/{{ $article->id }}">
                                                            <i class="far fa-edit mr-2"></i>
                                                      </a>
                                                </span>

                                <form class="inline" action="/articles/{{ $article->id }}" method="POST"
                                      accept-charset="utf-8">
                                    @csrf
                                    {{method_field('DELETE')}}
                                    <button class="icon-button" type="submit"><i class="fas fa-trash mr-2"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <p class="article-text">{{$article->body}}</p>
                    </div>

                    <div class="col-md-2 article-rating text-center">
                        <h5 class="rate-caption">Rate this article</h5>
                        @include('partials.social')
                    </div>

                </div>
            </div>

            <section id="comments" class="mt-4">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="text-center mb-4 comment-caption">Comment on this article</h3>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 comment-box">
                            <div class="comment-inner">

                                <comments></comments>

                            </div>
                        </div>

                    </div>
                </div>
        </div>
    </article-view>
    </section>
@endsection
