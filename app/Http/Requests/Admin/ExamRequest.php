<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ExamRequest extends FormRequest
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
                'title' => 'required|string|max:100',
                'code' => 'required|numeric|digits_between:1,8',
                'course_id' => 'required',
                'content' => 'required',
                'level_id' => 'nullable|numeric',
                'lesson_id' => 'nullable|numeric',
            ];
        }

        if($request->method() == "PUT")
        {
            return [
                'logo'=>'nullable|image|mimes:jpg,png,jpeg',
                'title' => 'required|string|max:100',
                'code' => 'required|numeric|digits_between:1,8',
                'course_id' => 'required',
                'content' => 'required',
                'level_id' => 'nullable|numeric',
                'lesson_id' => 'nullable|numeric',
            ];
        }


    }

    public function messages()
    {
        return [
            'title.required' => __('site.exam title required'),
            'title.string' => __('site.exam title string'),
            'title.max' => __('site.exam title max'),
            'code.required' => __('site.exam code required'),
            'code.digits_between' => __('site.exam code digits_between'),
            'title.numeric' => __('site.exam code numeric'),
            'title.max' => __('site.exam code max'),
            'course_id.required' => __('site.exam course required'),
            'content.required' => __('site.exam content required'),
            'level_id.numeric' => __('site.exam level numeric'),
            'lesson_id.numeric' => __('site.exam lesson numeric'),
        ];
    }

    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(redirect()->back()->withErrors($validator->errors())->withInput());
    }
}
