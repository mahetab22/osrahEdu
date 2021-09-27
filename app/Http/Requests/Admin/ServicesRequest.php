<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ServicesRequest extends FormRequest
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
                'title_ar'=>'required|string|max:100',
                'title_en'=>'nullable|string|max:100',
                'desc_ar'=>'required',
                'desc_en'=>'nullable',
            ];
        }

        if($request->method() == "PUT")
        {
            return [
                'logo'=>'nullable|image|mimes:jpg,png,jpeg',
                'title_ar'=>'required|string|max:100',
                'title_en'=>'nullable|string|max:100',
                'desc_ar'=>'required',
                'desc_en'=>'nullable',
            ];
        }


    }

    public function messages()
    {
        return [
            'logo.image'=>__('site.avatar image'),
            'logo.mimes'=>__('site.avatar mimes'),
            'title_ar.required'=>__('site.arabic title required'),
            'title_ar.max'=>__('site.arabic title max'),
            'title_en.max'=>__('site.english title max'),
            'desc_ar.required'=>__('site.arabic descrpiotion required'),
        ];
    }

    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(redirect()->back()->withErrors($validator->errors())->withInput());
    }
}
