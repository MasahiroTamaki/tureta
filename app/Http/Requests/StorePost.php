<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
      // 認可は別の場所で行う
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|max:20',
            'fishing_day' => 'required|date',
            'weather' => 'required',
            'time_zone' => 'required',
            'place' => 'required|max:20',
            'body' => 'required|max:400',
        ];
    }
}
