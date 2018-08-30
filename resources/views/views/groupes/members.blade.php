@extends('layout')

@section('content')
       <div class="header text-center">
            <h3 class="header-text">{{ $group->name }}</h3>
            <small>group</small>

            @if (count($group->users) === 1)
                  <p>1 member</p>
            @elseif (count($group->users) > 1)
                   <p>{{ count($group->users) }} members</p>
            @endif
      </div>

      <div class="container py-4">


            @foreach ($group->users as $user)
                  <div class="row">
                        <div class="col-md-12">
                              {{$user->name}}
                        </div>
                  </div>
            @endforeach



      </div>
@endsection
