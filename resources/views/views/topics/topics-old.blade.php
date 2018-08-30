@extends('layout')

@section('content')
      <div class="container">
            @include('partials.flash')

            <h3>Topics section</h3>

            @if (count($topics) === 1)
                  <p>1 topic</p>
            @elseif (count($topics) > 1)
                   <p>{{ count($topics) }} topics</p>
            @endif

            <p>Choose some topic of our topics...</p>

            @if ($group === 0)
                   <a href="/topics/create"><i class="fas fa-plus mb-3"></i>Add topic</a>
             @else
                   <a href="/topics/create/{{$group}}"><i class="fas fa-plus mb-3"></i>Add topic</a>
            @endif


            @if (count($topics) === 0)
                  <div class="row">
                        <div class="col-md-12">
                              <div class="alert-danger">
                                    No topics... please add some.
                              </div>
                        </div>
                  </div>
            @else

                  @foreach ($topics as $topic)
                        <div class="row mb-4">
                              <div class="col-md-12">
                                   <div class="card">
                                          <div class="row">
                                                <div class="col-md-2 image">

                                                </div>


                                                <div class="card-body col-md-10">
                                                      <h5 class="card-title">
                                                            <a href="/{{ $topic->id }}/show">{{ $topic->title }}</a>
                                                      </h5>
                                                      <p class="card-text">{{ $topic->description }}</p>
                                                      <p class="card-text">created by {{ $topic->user->name }} at {{ $topic->created_at }}</p>
                                                </div>

                                          </div>
                                    </div>
                              </div>
                        </div>
                  @endforeach

            @endif

      </div>
@endsection
