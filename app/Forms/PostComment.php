<?php

namespace App\Forms;

use App\Comment;
use App\Exceptions\ThrottleException;
use Illuminate\Foundation\Http\FormRequest;

class PostComment extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \Gate::allows('create', new Comment);
    }

      protected function failedAuthorization()
      {
            throw new ThrottleException(
                  'You are replying too frequently... take a minute break :)'
            );
      }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
              'body' => 'required|spamfree'
        ];
    }
}
