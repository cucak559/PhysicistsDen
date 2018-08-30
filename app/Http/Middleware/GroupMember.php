<?php

namespace App\Http\Middleware;

use Closure;

class GroupMember
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

      $request_id = $request->route('group');

      if (is_object($request_id)) {
            $request_id = $request_id->id;
      }else{
            $request_id = (int)$request_id;
      }

      if ($request->user()->groups->contains($request_id) || $request_id === 0) {
             return $next($request);
      }

      session()->flash('error','You are not member of this group. Ask for invite.');
      return redirect('/groups');

      }


    }

