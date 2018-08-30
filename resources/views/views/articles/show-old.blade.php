@extends('layout')

@section('content')
      <div class="container">

                  <h2 class="text-center">{{$article->title}}</h2>
                  <h4>rating : {{$article->rating}}</h4>
                  <h4>{{$article->description}}</h4>

                  <p>{{$article->body}}</p>

                  <div class="row">
                        <div class="col-md-8">
                               <p>Created at {{$article->created_at}} by {{$article->user->name}} </p>
                        </div>

                        <div class="col-md-4">
                               <div class="row">
                                    <div class="col-md-6 text-right">
                                          <button type="button" class="btn btn-primary"><a class="white" href="/{{$article->topic->id}}/articles/{{ $article->id }}/edit">Edit Article</a></button>
                                    </div>

                                    <div class="col-md-6">
                                          <form action="/{{ $article->topic->id }}/articles/{{$article->id}}" method="POST">
                                                {{csrf_field()}}
                                                {{method_field("DELETE")}}
                                                <button type="submit" class="btn btn-danger">Delete Article</button>
                                          </form>

                                    </div>
                               </div>
                        </div>
                  </div>

            <div class="row">
                  <div class="col-md-1">
                        <form action="/{{ $article->id }}/like" method="POST">
                              {{csrf_field()}}
                              <button type="submit" class="btn btn-success">Like</button>
                        </form>

                  </div>

                   <div class="col-md-1">
                        <form action="/{{ $article->id }}/dislike" method="POST">
                              {{csrf_field()}}
                              <button type="submit" class="btn btn-danger">Dislike</button>
                        </form>

                  </div>

                  <div class="col-md-2">
                        <form action="/favourites/{{ $article->id }}" method="POST">
                              {{csrf_field()}}
                              <button type="submit" class="btn btn-primary">Mark as Favourite</button>
                        </form>

                  </div>


                  <div class="col-md-6"></div>
            </div>





            <div class="comments">
                  <h4>Comments section</h4>

                  @if (count($article->comments) === 0)
                        <div class="row">
                              <div class="col-md-12">
                                    <div class="alert-danger">
                                          No Comments... please add some.
                                    </div>
                              </div>
                        </div>

                  @else
                        @foreach ($article->comments as $comment)
                              <div class="row mb-3">
                                    <div class="col-md-12">
                                           <div class="card">
                                                <div class="card-body">
                                                      <h5 class="card-title">{{ $comment->user->name }} at {{ $comment->created_at }}</h5>
                                                      <p class="card-text">{{ $comment->body }}</p>
                                                </div>
                                          </div>
                                    </div>
                              </div>
                        @endforeach
                  @endif

                  <h4>Add Comment</h4>

                  <form action="/{{$article->topic->id}}/{{$article->id}}/comments/store" method="POST">
                        {{csrf_field()}}

                        <div class="form-group">
                              <label>Body</label>
                              <input name='body' type="text" class="form-control" placeholder="Body">
                        </div>

                        <button type="submit" class="btn btn-success">Add Comment</button>

                  </form>
            </div>


      </div>



@endsection
