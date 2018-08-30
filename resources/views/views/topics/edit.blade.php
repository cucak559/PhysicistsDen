@extends('layout')

@section('content')
      <div class="container">

            <form action="/{{ $topic->id }}/update" method="POST">
                  {{csrf_field()}}
                  {{method_field("PATCH")}}

                  <div class="form-group">
                        <label>Title</label>
                        <input name='title' type="text" class="form-control" value="{{ $topic->title }}">
                  </div>

                  <div class="form-group">
                        <label>Description</label>
                        <input name='description' type="text" class="form-control" value="{{ $topic->description }}">
                  </div>

                  <button type="submit" class="btn btn-success">Edit</button>

            </form>

      </div>
@endsection
