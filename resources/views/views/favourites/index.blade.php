@extends('layout')

@section('content')
      <div class="header text-center">
            <h3 class="header-text">Favourites</h3>

            @if (count($favourites) === 1)
                  <p>1 favourite</p>
            @elseif (count($favourites) > 1)
                   <p>{{ count($favourites) }} favourites</p>
            @else
                  <p>No Favourties yet.</p>
            @endif
      </div>

      <div class="container">

                  @foreach ($favourites as $favourite)
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
                                                                  <a href="/{{$favourite->favouritable->topic->id}}/show">
                                                                        {{ $favourite->favouritable->topic->title }}
                                                                  </a>
                                                            </h4>



                                                            <h2 class="card-title article-name">
                                                                  <a class="article" href="/articles/show/{{ $favourite->favouritable->id }}">
                                                                        {{ $favourite->favouritable->title }}
                                                                  </a>
                                                            </h2>
                                                            <p class="card-text article-owner"><em class="owner-by mr-1">By</em> <span class="owner-name">{{ $favourite->favouritable->user->name }}</span></p>
                                                            <p class="card-text article-description">
                                                                 {{ $favourite->favouritable->description }}
                                                            </p>

                                                             <p>
                                                                 Tags:
                                                                 @foreach ($favourite->favouritable->tags as $tag)
                                                                        <a href="/favouritable/bytag/{{ $tag->tag_id }}"><span>{{ $tag->name}}</span></a>
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
@endsection
