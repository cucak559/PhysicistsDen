<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy {
      use HandlesAuthorization;

      /**
       * Determine whether the user can view the comment.
       *
       * @param  \App\User $user
       * @return mixed
       */
      public function view(User $user)
      {
            //
      }

      /**
       * Determine whether the user can create comments.
       *
       * @param  \App\User $user
       * @return mixed
       */
      public function create(User $user)
      {
            //
      }

      /**
       * Determine whether the user can update the comment.
       *
       * @param  \App\User $user
       * @param User       $signedInUser
       * @return mixed
       */
      public function update(User $user , User $signedInUser)
      {
           return $user->id ===  $signedInUser->id;
      }

      /**
       * Determine whether the user can delete the comment.
       *
       * @param  \App\User $user
       * @return mixed
       */
      public function delete(User $user)
      {
            //
      }

      /**
       * Determine whether the user can restore the comment.
       *
       * @param  \App\User $user
       * @return mixed
       */
      public function restore(User $user)
      {
            //
      }

      /**
       * Determine whether the user can permanently delete the comment.
       *
       * @param  \App\User $user
       * @return mixed
       */
      public function forceDelete(User $user)
      {
            //
      }
}
