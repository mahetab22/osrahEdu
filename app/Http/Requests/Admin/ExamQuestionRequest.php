<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ExamQuestionRequest extends FormRequest
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
            'q_type' => 'required',
            'co' => 'required|numeric',
            'question' => 'required|string|max:1000',
            'a.0' => 'required|max:1000',
            'a.1' => 'required|max:1000',
            'a.2' => [ $request->q_type == 1 ? 'nullable' : 'required','max:1000'],
            'a.3' => [ $request->q_type == 1 ? 'nullable' : 'required','max:1000']
        ];
    }

    public function messages()
    {
        return [
            'question.required' => __('site.exam question required'),
            'question.max' => __('site.exam question max'),
            'q_type.required' => __('site.exam question type required'),
            'co.required' => __('site.exam question correct answer required'),
            'co.numeric' => __('site.exam question correct answer numeric'),
            'a.0.required' => __('site.exam question first answer required'),
            'a.0.max' => __('site.exam question first answer max'),
            'a.1.required' => __('site.exam question second answer required'),
            'a.1.max' => __('site.exam question second answer max'),
            'a.2.required' => __('site.exam question third answer required'),
            'a.2.max' => __('site.exam question third answer max'),
            'a.3.required' => __('site.exam question fourth answer required'),
            'a.3.max' => __('site.exam question fourth answer max'),
        ];
    }

    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(redirect()->back()->withErrors($validator->errors())->withInput());
    }
}
