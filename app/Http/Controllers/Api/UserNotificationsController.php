<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;

class UserNotificationsController extends Controller {

      public function __construct()
      {
            $this->middleware('auth');
      }

      /**
       * @return mixed
       */

      public function index()
      {
            return auth()->user()->unreadNotifications;

      }

      /**
       * @param User $user
       * @param      $notificationId
       */

      public function destroy(User $user , $notificationId)
      {
            auth()->user()->notifications()->findOrFail($notificationId)->markAsRead();
      }
}
