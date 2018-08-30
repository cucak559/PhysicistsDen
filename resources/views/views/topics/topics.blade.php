@extends('layout')

@section('content')
      <div class="header text-center">
            <h3 class="header-text">All topics</h3>

              @if ($group === 0)
                   <a href="/topics/create"><i class="fas fa-plus mb-3"></i>Add topic</a>
             @else
                   <a href="/topics/create/{{$group}}"><i class="fas fa-plus mb-3"></i>Add topic</a>
            @endif

            <p>{{count($topics)}} {{str_plural('topic',count($topics))}}</p>


      </div>
      <div class="container py-2">

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
                       @include('partials.topic')
                  @endforeach

            @endif

      </div>
@endsection
