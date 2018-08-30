<?php

namespace App\Http\Controllers;

use App\Topic;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTopic;

class TopicController extends Controller {

      public function __construct()
      {
            $this->middleware('auth');
            $this->middleware('group')->except(['show' , 'edit' , 'update' , 'destroy']);
      }

      /**
       * Display a listing of the resource.
       *
       * @param int $group
       * @return \Illuminate\Http\Response
       */
      public function index($group = 0)
      {
            $topics = Topic::latest()
                  ->where('group_id' , $group)
                  ->get();

            return view('views.topics.topics' , compact('topics' , 'group'));
      }

      /**
       * Show the form for creating a new resource.
       *
       * @param int $group
       * @return \Illuminate\Http\Response
       */
      public function create($group = 0)
      {
            return view('views.topics.create' , compact('group'));
      }

      /**
       * Store a newly created resource in storage.
       *
       * @param  \Illuminate\Http\Request $request
       * @return \Illuminate\Http\Response
       */
      public function store(Request $request , $group = 0 , StoreTopic $validation)
      {
            $topic = new Topic;

            $topic->user_id = auth()->user()->id;
            $topic->group_id = $group;
            $topic->title = request('title');
            $topic->description = request('description');

            $topic->save();

            session()->flash('message' , 'Topic has been created');

            if ($group === 0)
            {
                  return redirect('topics/all');
            }

            return redirect('/topics/all/' . $group);


      }

      /**
       * Display the specified resource.
       *
       * @param Topic $topic
       * @return \Illuminate\Http\Response
       */
      public function show(Topic $topic)
      {
            return view("views.topics.show" , compact("topic"));
      }

      /**
       * Show the form for editing the specified resource.
       *
       * @param Topic $topic
       * @return \Illuminate\Http\Response
       */
      public function edit(Topic $topic)
      {
            if (auth()->user()->id === $topic->user_id)
            {
                  return view("views.topics.edit" , compact("topic"));
            }
            return back();
      }

      /**
       * Update the specified resource in storage.
       *
       * @param  \Illuminate\Http\Request $request
       * @param Topic                     $topic
       * @return \Illuminate\Http\Response
       */
      public function update(Request $request , Topic $topic)
      {
            if (auth()->user()->id === $topic->user_id)
            {
                  $topic->title = request('title');
                  $topic->description = request('description');

                  $topic->save();
            }

            return redirect('topics/all');
      }

      /**
       * Remove the specified resource from storage.
       *
       * @param Topic $topic
       * @return \Illuminate\Http\Response
       */
      public function destroy(Topic $topic)
      {
            if (auth()->user()->id === $topic->user_id)
            {
                  $topic->articles()->delete();
                  Topic::destroy($topic->id);
            }

            return back();
      }

}
