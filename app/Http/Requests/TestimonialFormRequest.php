<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TestimonialFormRequest extends FormRequest
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
        return [
            'name' => 'required|string|min:5|max:100',
            'text' => 'required|string|min:5|max:110',
            'author' => 'required|string|min:5|max:200',
            'file_url' => '',
            'author_jobposition' => '',
            'sort' => ''
        ];
    }
}
