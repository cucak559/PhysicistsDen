@extends('layout')

@section('content')
       <div class="header text-center">
            <h3 class="header-text">{{ $group->name }}</h3>
            <small>group</small>
      </div>

      <div class="container py-4">
            <div class="row about">

                  <div class="col-md-6 about-out text-center">
                        <div class="about-inner">
                              <i class="fas fa-users icons"></i>
                              <a href="/groups/{{ $group->id }}/members">
                                    <h3>Show Members</h3>
                              </a>
                              <p>Good to know your mates.</p>
                        </div>

                  </div>

                  <div class="col-md-6 about-out text-center">
                        <div class="about-inner">
                              <i class="fas fa-question icons"></i>
                              <h3><a href="/groups/{{ $group->id }}/aplicants">Show Aplicants</a></h3>
                              <p>Have a look at new faces.</b></p>
                         </div>
                  </div>

            </div>

            <div class="row about">

                  <div class="col-md-6 about-out text-center">
                        <div class="about-inner">
                              <i class="fas fa-newspaper icons"></i>
                              <h3><a href="/articles/all/{{ $group->id }}">Show Articles</a></h3>
                              <p>Read some private articles.</p>
                         </div>
                  </div>

                   <div class="col-md-6 about-out text-center">
                        <div class="about-inner">
                              <i class="fas fa-object-group icons"></i>
                              <h3><a href="/topics/all/{{ $group->id }}" title="">Show Topics</a></h3>
                              <p>Read some private topics.</p>
                         </div>
                  </div>
             </div>

           {{--  <a href="/groups/{{ $group->id }}/members">Show Members</a><br>
             <a href="/groups/{{ $group->id }}/aplicants">Show Aplicants</a><br>
            <a href="/articles/all/{{ $group->id }}">Show Articles</a><br>
            <a href="/topics/all/{{ $group->id }}" title="">Show Topics</a> --}}
      </div>
@endsection
