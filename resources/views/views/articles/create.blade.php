@extends('layout')

@section('content')
    <div class="container py-5">

        <form class="mt-5" action="/{{$topic}}/articles/store" method="POST">
            {{csrf_field()}}

            @if ($topic === 0)
                <div class="form-group">
                    <label>Select Topic</label>
                    <select name='topic_id' id="topic_id" class="form-control" required>
                        @foreach ($topics as $topic)
                            <option value="{{ $topic->id }}">{{ $topic->title }}</option>
                        @endforeach
                    </select>
                </div>

            @endif

            <div class="form-group">
                <label>Title</label>
                <input name='title' type="text" class="form-control" placeholder="Title" required>
            </div>

            <div class="form-group">
                <label>Description</label>
                <input name='description' type="text" class="form-control" placeholder="Description" required>
            </div>

            <div class="form-group">
                <label>Body</label>
                <input name='body' type="text" class="form-control" placeholder="Body" required>
            </div>

            <div class="form-group">
                <label>Tags</label>
                <input name='tags' id="tags" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-success">Create</button>

            @include('partials.errors')

        </form>



    </div>

    {{--<script>--}}
    {{--var tags = [--}}
    {{--@foreach ($tags as $tag)--}}
    {{--{tag: "{{$tag}}" },--}}
    {{--@endforeach--}}
    {{--];--}}
    {{--</script>--}}

@endsection
