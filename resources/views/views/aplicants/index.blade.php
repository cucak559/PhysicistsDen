@extends('layout')

@section('content')
      <div class="container">
           @if (count($aplicants) === 1)
                  <p>1 aplicant</p>
            @elseif (count($aplicants) > 1)
                   <p>{{ count($aplicants) }} aplicants</p>
            @endif

            <hr>

             @if (count($aplicants) === 0)
                  <div class="row">
                        <div class="col-md-12">
                              <div class="alert-danger">
                                    No aplicants.
                              </div>
                        </div>
                  </div>
            @else

                  @foreach ($aplicants as $aplicant)
                        <div class="row">
                                    <div class="col-md-6">
                                          {{$aplicant->user->name}}
                                    </div>

                                    <div class="col-md-6 text-right">
                                          <form action="/groups/{{ Auth::user()->group_id  }}/hire/{{$aplicant->id}}" method="POST" accept-charset="utf-8">
                                                {{csrf_field()}}
                                                <button class="btn btn-success" type="submit">Accept Aplicant</button>
                                          </form>

                                    </div>
                              </div>
                  @endforeach
            @endif


      </div>
@endsection
