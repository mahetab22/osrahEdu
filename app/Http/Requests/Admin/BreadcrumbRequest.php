<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class BreadcrumbRequest extends FormRequest
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
                'title_ar'=>'required|string|max:100',
                'title_en'=>'nullable|string|max:100',
                'link_url'=>'required|string|max:500',
            ];
        }

        if($request->method() == "PUT")
        {
            return [
                'image'=>'nullable|image|mimes:jpg,png,jpeg',
                'title_ar'=>'required|string|max:100',
                'title_en'=>'nullable|string|max:100',
                'link_url'=>'required|string|max:500',
            ];
        }


    }

    public function messages()
    {
        return [
            'image.required'=>__('site.breadcrumb image required'),
            'image.image'=>__('site.breadcrumb image image'),
            'image.mimes'=>__('site.breadcrumb image mimes'),
            'title_ar.required'=>__('site.breadcrumb arabic title required'),
            'title_en.required'=>__('site.breadcrumb english title required'),
            'title_ar.max'=>__('site.breadcrumb title max'),
            'title_en.max'=>__('site.breadcrumb title max'),
            'link_url.required'=>__('site.breadcrumb link url required'),
        ];
    }

    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(redirect()->back()->withErrors($validator->errors())->withInput());
    }
}
