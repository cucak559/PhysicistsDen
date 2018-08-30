@extends('layout')

@section('content')
      <div class="header text-center">
            <h3 class="header-text">{{ $group->name }}</h3>
            <small>aplicants</small>

            @if (count($group->aplicants) === 1)
                  <p>1 aplicant</p>
            @elseif (count($group->aplicants) > 1)
                  <p>{{ count($group->aplicants) }} aplicants</p>
            @else
                  <p>No aplicants</p>
            @endif
      </div>

      <div class="container py-4">

            @foreach ($group->aplicants as $aplicant)
                  <div class="row">
                        <div class="col-md-12">
                              <div class="row">
                                    <div class="col-md-6">
                                          {{ $aplicant->user->name }}
                                    </div>

                                    <div class="col-md-6">
                                           <form action="/groups/{{ $group->id }}/invite/{{ $aplicant->id }}" method="POST">
                                                {{csrf_field()}}
                                                <button type="submit" class="btn btn-success">Invite</button>
                                          </form>
                                    </div>

                              </div>
                        </div>
                  </div>
            @endforeach



      </div>
@endsection
