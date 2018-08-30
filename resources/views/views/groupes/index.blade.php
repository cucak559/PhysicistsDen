@extends('layout')

@section('content')
       <div class="header text-center">
            <h3 class="header-text">My Groups</h3>
      </div>

      <div class="container">
            <div class="row py-4">
                  <div class="col-md-4">
                        @foreach (Auth::user()->groups as $group)
                              <a href="/groups/{{ $group->id }}">{{$group->name}}</a><br>
                        @endforeach
                  </div>

                  <div class="col-md-4">
                        <h3>Create Group</h3>

                         <form action="/groups" method="POST">
                              {{csrf_field()}}

                              <div class="form-group">
                                    <label>Name</label>
                                    <input name='name' type="text" class="form-control" placeholder="Name">
                              </div>

                              <button type="submit" class="btn btn-success">Create</button>

                        </form>
                  </div>

                  <div class="col-md-4">
                        <h3>Join into group</h3>

                        @foreach ($groups as $group)
                              <div class="row">
                                    <div class="col-md-6">
                                          {{$group->name}}
                                    </div>

                                    <div class="col-md-6">
                                          <form action="{{ $group->id }}/aplicants" method="POST" accept-charset="utf-8">
                                                {{csrf_field()}}
                                                <button type="submit">Ask for join</button>
                                          </form>

                                    </div>
                              </div>
                        @endforeach
                  </div>
            </div>
      </div>
@endsection
