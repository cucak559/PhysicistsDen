@extends('layout')

@section('content')
      <div class="container">

            <form action="/articles/{{ $article->id }}" method="POST">
                  {{csrf_field()}}
                  {{method_field("PATCH")}}

                  <div class="form-group">
                        <label>Title</label>
                        <input name='title' type="text" class="form-control" value="{{ $article->title }}">
                  </div>

                  <div class="form-group">
                        <label>Description</label>
                        <input name='description' type="text" class="form-control" value="{{ $article->description }}">
                  </div>

                  <div class="form-group">
                        <label>Body</label>
                        <input name='body' type="text" class="form-control" value="{{ $article->body }}">
                  </div>

                  <div class="form-group">
                        <label>Tags</label>
                        <input name='tags' id="tags" type="text" class="form-control" value="{{ $article->tagList }}">
                  </div>

                  <button type="submit" class="btn btn-success">Edit</button>

            </form>

      </div>

      <script>
             var tags = [
                @foreach ($tags as $tag)
                {tag: "{{$tag}}" },
                @endforeach
            ];
      </script>
@endsection
