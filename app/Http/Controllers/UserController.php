<?php

namespace App\Http\Controllers;

use App\User;
use App\Activity;
use Illuminate\Http\Request;

class UserController extends Controller {

      /**
       * Display the specified resource.
       *
       * @param User $user
       * @return \Illuminate\Http\Response
       */
      public function show(User $user)
      {
            $activities = Activity::feed($user);

            return view('views.users.show' , compact('user' , 'activities'));
      }

}
