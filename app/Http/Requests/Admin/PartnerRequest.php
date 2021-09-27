<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class PartnerRequest extends FormRequest
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
            ];
        }

        if($request->method() == "PUT")
        {
            return [
                'logo'=>'nullable|image|mimes:jpg,png,jpeg',
                'title'=>'required|string|max:50',
            ];
        }
    }

    public function messages()
    {
        return [
            'logo.required'=>__('site.partner logo required'),
            'logo.image'=>__('site.partner logo image'),
            'logo.mimes'=>__('site.partner logo mimes'),
            'title.required'=>__('site.title required'),
            'title.max'=>__('site.title max'),
        ];
    }

    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(redirect()->back()->withErrors($validator->errors())->withInput());
    }


}
