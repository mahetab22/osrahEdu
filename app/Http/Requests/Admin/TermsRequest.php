<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class TermsRequest extends FormRequest
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
    public function rules(Request $request)
    {
            return [
                'title_ar'=>'required|string|max:100',
                // 'title_en'=>'required|string|max:100',
                'terms_ar'=>'required',
                // 'terms_en'=>'required',
            ];

    }

    public function messages()
    {
        return [
            'title_ar.required'=>__('site.term title required'),
            'title_ar.required'=>__('site.term arabic title required'),
            'title_en.required'=>__('site.term  english title required'),
            'terms_ar.required'=>__('site.terms descrpiotion required'),
            'terms_ar.required'=>__('site.terms arabic description required'),
            'terms_en.required'=>__('site.terms english description required'),
        ];
    }

    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(redirect()->back()->withErrors($validator->errors())->withInput());
    }
}
