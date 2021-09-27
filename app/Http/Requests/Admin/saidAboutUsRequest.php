<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class saidAboutUsRequest extends FormRequest
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
                'username'=>'required|string|max:50',
                'job'=>'required|string|max:50',
                'rate'=>'required',
                'comment'=>'required|string|max:70',
            ];
        }

        if($request->method() == "PUT")
        {
            return [
                'logo'=>'image|mimes:jpg,png,jpeg',
                'username'=>'required|string|max:50',
                'job'=>'required|string|max:50',
                'rate'=>'required',
                'comment'=>'required|string|max:70',
            ];
        }


    }

    public function messages()
    {
        return [
            'logo.image'=>__('site.avatar image'),
            'logo.mimes'=>__('site.avatar mimes'),
            'username.required'=>__('site.username required'),
            'comment.required'=>__('site.comment required'),
            'job.required'=>__('site.job required'),
            'rate.required'=>__('site.rate required'),
        ];
    }

    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(redirect()->back()->withErrors($validator->errors())->withInput());
    }
}
