@extends('layout')

@section('content')
    <div class="header text-center">
        <h3 class="header-text">{{ $user->name }} </h3>

        @if (count($user->activity) === 1)
            <p>1 activity</p>
        @elseif (count($user->activity) > 1)
            <p>{{ count($user->activity) }} activities</p>
        @else
            <p>No activities yet.</p>
        @endif

        {{--@can('update',$user)--}}
            {{--<form method="POST" action="/api/users/{{ $user->id }}/avatar" enctype="multipart/form-data">--}}
                {{--@csrf--}}

                {{--<input type="file" name="avatar" id="avatar">--}}
                {{--<button type="submit" class="btn btn-outline-secondary">Add Avatar</button>--}}
            {{--</form>--}}

        {{--@endcan--}}

        {{--<img src="{{ asset('storage/'.$user->avatar_path) }}" alt="Profile Pic" width="200" height="200">--}}
    </div>

    <div class="container">

        @forelse  ($activities as $date => $activity)
            <div class="col-md-12 mb-1">
                <h3>{{$date}}</h3>
            </div>
            @foreach ($activity as $record)
                <div class="col-md-12">
                    @if (view()->exists("views.users.activities.{$record->type}"))
                        @include("views.users.activities.{$record->type}",['activity' => $record])
                    @endif
                    <hr>
                </div>
            @endforeach

        @empty
            <p>There is no activity for this user yet.</p>
        @endforelse

    </div>
@endsection

