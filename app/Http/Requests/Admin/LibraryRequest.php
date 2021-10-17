<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class LibraryRequest extends FormRequest
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
                'image'=>'required|image|mimes:jpg,png,jpeg',
                'pdf'=>'required|mimetypes:application/pdf|max:10240',
                'title'=>'required|string|max:100',
                'short_desc'=>'required',
            ];
        }

        if($request->method() == "PUT")
        {
            return [
                'image'=>'nullable|image|mimes:jpg,png,jpeg',
                'pdf'=>'nullable|mimetypes:application/pdf|max:10240',
                'title'=>'required|string|max:100',
                'short_desc'=>'required',
            ];
        }


    }

    public function messages()
    {
        return [
            'image.required'=>__('site.image required'),
            'image.image'=>__('site.image image'),
            'image.mimes'=>__('site.image mimes'),
            'pdf.required'=>__('site.pdf required'),
            'pdf.mimes'=>__('site.pdf mimes'),
            'pdf.max'=>__('site.pdf max'),
            'title.required'=>__('site.book title required'),
            'short_desc.required'=>__('site.book descrpiotion required'),
        ];
    }

    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(redirect()->back()->withErrors($validator->errors())->withInput());
    }
}
