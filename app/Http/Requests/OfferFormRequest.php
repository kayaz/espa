<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class OfferFormRequest extends FormRequest
{
    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'slug' => Str::slug($this->title)
        ]);
    }

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
            'title' => 'required|string|min:2|max:250',
            'content' => 'required|string',
            'content_entry' => 'required|string|min:5|max:250',
            'meta_title' => '',
            'meta_description' => '',
            'meta_robots' => '',
            'slug' => 'required'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => 'To pole jest wymagane',
            'title.max.string' => 'Maksymalna ilość znaków: 250',
            'title.min.string' => 'Minimalna ilość znaków: 5',
            'content_entry.required' => 'To pole jest wymagane',
            'content_entry.max.string' => 'Maksymalna ilość znaków: 250',
            'content_entry.min.string' => 'Minimalna ilość znaków: 5',
            'content.required' => 'To pole jest wymagane'
        ];
    }
}

