@extends('layout')

@section('content')
      <div class="header text-center">
            <h3 class="header-text">Archives</h3>
      </div>

      <div class="container py-4">

            @foreach ($archives as $archive)
                 <div class="row mb-2">
                         <a href="/articles/all/?month={{ $archive['month'] }}&year={{ $archive['year'] }}">{{ $archive['month'] }} {{ $archive['year'] }}</a>
                 </div>
            @endforeach
      </div>
@endsection
