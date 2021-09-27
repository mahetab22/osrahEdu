<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UsersRequest extends FormRequest
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
                'avatar'=>'nullable|image|mimes:jpg,png,jpeg',
                'name'=>'required|string|max:100',
                'password'=>'required|min:6',
                'email'=>'required|email:rfc,dns|regex:/(.+)@(.+)\.(.+)/i|unique:users',
                'phone'=>'nullable|numeric|digits_between:8,12',
                'age'=>'nullable|min:2',
                'role'=>'required',
            ];
        }

        if($request->method() == "PUT")
        {
            return [
                'avatar'=>'nullable|image|mimes:jpg,png,jpeg',
                'name'=>'required|string|max:100',
                'password'=>'nullable|min:6',
                'email'=>'nullable|email:rfc,dns|regex:/(.+)@(.+)\.(.+)/i|unique:users,email,'.$request->id,
                'phone'=>'nullable|numeric|digits_between:8,12',
                'age'=>'nullable|numeric|min:2',
                'role'=>'required',
            ];
        }


    }

    public function messages()
    {
        return [
            'avatar.image'=> __('site.avatar image'),
            'avatar.mimes'=> __('site.mimes image'),
            'name.required'=> __('site.name required'),
            'name.max'=> __('site.name max'),
            'password.required'=> __('site.password required'),
            'password.min'=> __('site.password min'),
            'email.required'=> __('site.email required'),
            'email.email'=> __('site.email email'),
            'phone.digits_between'=> __('site.phone digits_between'),
            'phone.numeric'=> __('site.phone numeric'),
            'role.required'=> __('site.role required'),
            'age.min'=> __('site.age min'),
            'age.numeric'=> __('site.age numeric'),
        ];
    }

    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(redirect()->back()->withErrors($validator->errors())->withInput());
    }
}
