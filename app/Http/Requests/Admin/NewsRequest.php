<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class NewsRequest extends FormRequest
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
        if($request->method() == "POST")
        {
            return [
                'logo'=>'required|image|mimes:jpg,png,jpeg',
                'title'=>'required|string|max:100',
                'short_desc'=>'nullable|string|max:150',
                'desc'=>'required',
            ];
        }

        if($request->method() == "PUT")
        {
            return [
                'logo'=>'image|mimes:jpg,png,jpeg',
                'title'=>'required|string|max:50',
                'short_desc'=>'string|max:100',
                'desc'=>'required',
            ];
        }


    }

    public function messages()
    {
        return [
            'logo.image'=>__('site.avatar image'),
            'logo.mimes'=>__('site.avatar mimes'),
            'title.required'=>__('site.title required'),
            'title.max'=>__('site.title max'),
            'short_desc.max'=>__('site.short description max'),
            'desc.required'=>__('site.descrpiotion required'),
        ];
    }

    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(redirect()->back()->withErrors($validator->errors())->withInput());
    }
}
