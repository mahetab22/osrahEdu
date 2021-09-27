<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class TeacherRequest extends FormRequest
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
            'user_id'=>'required',
            'name_ar'=>'required|string|max:100',
            'name_en'=>'nullable|string|max:100',
            'educational'=>'required|max:100',
            'educational_en'=>'nullable|max:100',
            'service_id'=>'required',
            'curriculum_ar'=>'required|max:250',
            'skill1_ar'=>'required|max:250',
            'skill2_ar'=>'required|max:250',
            'skill3_ar'=>'nullable|max:250',
            'curriculum_en'=>'nullable|max:250',
            'skill1_en'=>'nullable|max:250',
            'skill2_en'=>'nullable|max:250',
            'skill3_en'=>'nullable|max:250',
            'facebook'=>'nullable',
            'twitter'=>'nullable',
            'instagram'=>'nullable',
            'google'=>'nullable',
        ];



    }

    public function messages()
    {

        return [
            'user_id.required'=>__('site.teacher user id required'),
            'name_ar.required'=>__('site.teacher arabic name required'),
            'name_en.required'=>__('site.teacher english name required'), //When using multilanguage add in migrate first
            'name_ar.max'=>__('site.teacher arabic name max'),
            'name_en.max'=>__('site.teacher english name max'), // When using multilanguage add in migrate first
            'educational.required'=>__('site.teacher arabic educational max'),
            'educational_ar.max'=>__('site.teacher arabic educational max'),
            'educational_en.required'=>__('site.teacher english educational max'), //When using multilanguage add in migrate first
            'educational_en.max'=>__('site.teacher english educational max'), //When using multilanguage add in migrate first
            'service_id.required'=>__('site.teacher service required'),

            'facebook.max'=>__('site.teacher facebook max'),
            'twitter.max'=>__('site.teacher twitter max'),
            'instagram.max'=>__('site.teacher instagram max'),
            'google.max'=>__('site.teacher google max'),


            'curriculum_ar.required'=>__('site.teacher arabic profile required'),
            'skill1_ar.required'=>__('site.teacher arabic skill1 required'),
            'skill2_ar.max'=>__('site.teacher arabic skill1 max'),
            'skill2_ar.max'=>__('site.teacher arabic skill1 max'),
            'skill1_en.required'=>__('site.teacher english skill1 required'), //When using multilanguage add in migrate first
            'skill2_en.max'=>__('site.teacher english skill1 max'), //When using multilanguage add in migrate first
            'skill2_en.max'=>__('site.teacher english skill1 max'), //When using multilanguage add in migrate first
        ];
    }

    protected function failedValidation(Validator $validator) {
        dd($validator);
        throw new HttpResponseException(redirect()->back()->withErrors($validator->errors())->withInput());
    }
}
