<div class="row mb-4">
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

                            @if($article->hasUpdatesFor())
                                <span class="ml-2 badge badge-pill badge-primary">Updated</span>
                            @endif
                        </h2>

                        <div>
                            <a class="card-text article-owner" href="/user/{{$article->user->id}}">
                                <em class="owner-by mr-1">By</em>
                                <span class="owner-name">{{ $article->user->name }}</span>
                            </a>

                            <span> -</span>

                            <a href="/articles/all?views=1">
                                <span>
                                    <i class="fas fa-eye"></i> {{$article->views}}
                                </span>
                            </a>

                            <span>
                                | <i class="far fa-heart"></i>{{count($article->favourites)}}
                            </span>

                            <span>
                                | <i class="far fa-thumbs-up"></i>{{count($article->likes)}}
                            </span>

                            <span>
                                | <i class="far fa-thumbs-down"></i>{{count($article->dislikes)}}
                            </span>

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
