@extends('layout')

@section('content')
      <div class="container py-5">

            @if ($group === 0)
                  <form class="mt-5" action="/topics/store" method="POST">
            @else
                  <form class="mt-5" action="/topics/store/{{$group}}" method="POST">
            @endif

                  {{csrf_field()}}

                  <div class="form-group">
                        <label>Title</label>
                        <input name='title' type="text" class="form-control" placeholder="Title" required>
                  </div>

                  <div class="form-group">
                        <label>Description</label>
                        <input name='description' type="text" class="form-control"  placeholder="Description" required>
                  </div>

                  <button type="submit" class="btn btn-success">Create</button>

            </form>

            @include('partials.errors')

      </div>

@endsection
