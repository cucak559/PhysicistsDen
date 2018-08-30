<?php

namespace App\Http\Controllers;

use App\User;
use App\Group;
use App\Aplicant;
use Illuminate\Http\Request;


class GroupController extends Controller {

      public function __construct()
      {
            $this->middleware('auth');
            $this->middleware('group')->except(['index' , 'invite']);
      }

      /**
       * Display a listing of the resource.
       *
       * @return \Illuminate\Http\Response
       */
      public function index()
      {

            $groups = Group::whereDoesntHave('users' , function ($q)
            {
                  $q->where('id' , auth()->user()->id);
            })->get();

            return view('views.groupes.index' , compact('groups'));
      }

      /**
       * Show the form for creating a new resource.
       *
       * @return \Illuminate\Http\Response
       */
      public function create()
      {
            return view('views.groupes.create');
      }

      /**
       * Store a newly created resource in storage.
       *
       * @param  \Illuminate\Http\Request $request
       * @return \Illuminate\Http\Response
       */
      public function store(Request $request)
      {
            $this->validate(request() , [
                  'name' => 'required'
            ]);

            $group = new Group;

            $group->name = request('name');
            $group->save();

            $user = User::find(auth()->user()->id);
            if ( ! $user->groups->contains($group->id))
            {
                  $user->groups()->attach($group->id);
            }

            return redirect('/groups');
      }

      public function aplicants(Group $group)
      {
            return view('views.groupes.aplicants' , compact('group'));
      }

      public function invite(Group $group , Aplicant $aplicant)
      {
            $user = User::find($aplicant->user_id);

            if ( ! $user->groups->contains($group->id))
            {
                  $user->groups()->attach($group->id);
            }

            $group->aplicants()->detach($aplicant->id);


            return redirect('articles/all');
      }

      /**
       * Display the specified resource.
       *
       * @param Group $group
       * @return \Illuminate\Http\Response
       */
      public function show(Group $group)
      {
            return view('views.groupes.show' , compact('group'));
      }

      public function members(Group $group)
      {
            return view('views.groupes.members' , compact('group'));
      }


      /**
       * Remove the specified resource from storage.
       *
       * @param Group $group
       * @return void
       */
      public function destroy(Group $group)
      {
            if (auth()->user()->id === $group->user_id)
            {
                  foreach ($group->users as $user)
                  {
                        $user->group_id = 0;
                  }
                  Group::destroy($group->id);
            }
      }
}
