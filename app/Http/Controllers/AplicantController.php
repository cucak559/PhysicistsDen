<?php

namespace App\Http\Controllers;

use App\Group;
use App\Aplicant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AplicantController extends Controller {

      public function __construct()
      {
            $this->middleware('auth');
            $this->middleware('group')->except('store');
      }

      /**
       * Display a listing of the resource.
       *
       * @param Group $group
       * @return \Illuminate\Http\Response
       */
      public function index(Group $group)
      {
            $aplicants = Aplicant::where('group_id' , Auth::user()->group_id)
                  ->get();

            return view('views.aplicants.index' , compact('aplicants'));
      }

      /**
       * Store a newly created resource in storage.
       *
       * @param  \Illuminate\Http\Request $request
       * @param Group                     $group
       * @return \Illuminate\Http\Response
       */
      public function store(Request $request , Group $group)
      {
            $aplicant = new Aplicant;
            $aplicant->user_id = auth()->user()->id;
            $aplicant->save();

            $group->aplicants()->attach($aplicant->id);


            return redirect('articles/all');
      }
}

