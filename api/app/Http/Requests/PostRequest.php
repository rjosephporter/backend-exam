<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'title' => ['unique:posts,title']
        ];

        if($this->route()->getName() == 'posts.store') {
            $rules['title'][] = 'required';
            $rules['content'] = 'required';
        }

        return $rules;
    }
}
