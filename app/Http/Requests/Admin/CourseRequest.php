<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CourseRequest extends FormRequest
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
                'supervisor_id'=>'required',
                'title_ar'=>'required|string|max:100',
                'title_en'=>'nullable|string|max:100',
                'desc_ar'=>'required',
                'desc_en'=>'nullable',
                'duration'=>'required|numeric|min:1|max:1000',
                'start_date'=>'required|date|after:yesterday',
                'end_date'=>'required|date|after:start_date',
                'feature1_ar'=>'required|max:250',
                'feature2_ar'=>'required|max:250',
                'feature3_ar'=>'nullable|max:250',
                'feature1_en'=>'nullable|max:250',
                'feature2_en'=>'nullable|max:250',
                'feature3_en'=>'nullable|max:250',
                'type'=>'required',
                'link'=>'required',
                'price'=>'required|numeric',
                'link_url'=>'required',
                'link_name'=>'required|max:250',
                'discount'=>'nullable|numeric|max:100',
            ];
        }

        if($request->method() == "PUT")
        {
            return [
                'logo'=>'nullable|image|mimes:jpg,png,jpeg',
                'supervisor_id'=>'required',
                'title_ar'=>'required|string|max:100',
                'title_en'=>'nullable|string|max:100',
                'desc_ar'=>'required',
                'desc_en'=>'nullable',
                'duration'=>'required|numeric|min:1|max:1000',
                'start_date'=>'required|date|after:yesterday',
                'end_date'=>'required|date|after:start_date',
                'feature1_ar'=>'required|max:250',
                'feature2_ar'=>'required|max:250',
                'feature3_ar'=>'nullable|max:250',
                'feature1_en'=>'nullable|max:250',
                'feature2_en'=>'nullable|max:250',
                'feature3_en'=>'nullable|max:250',
                'type'=>'required',
                'link'=>'required',
                'price'=>'required|numeric',
                'link_url'=>'required',
                'link_name'=>'required|max:250',
                'discount'=>'nullable|numeric|max:100',
            ];
        }


    }

    public function messages()
    {
        return [
            'supervisor_id.required'=>__('site.supervisor required'),
            'logo.required'=>__('site.course logo required'),
            'logo.image'=>__('site.avatar image'),
            'logo.mimes'=>__('site.avatar mimes'),
            'title_ar.required'=>__('site.course title required'),
            'title_ar.max'=>__('site.course title max'),
            'title_en.max'=>__('site.course title max'),
            'desc_ar.required'=>__('site.course descrpiotion required'),
            'feature1_ar.required'=>__('site.course feature1 required'),
            'feature1_ar.max'=>__('site.course feature1 max'),
            'feature2_ar.required'=>__('site.course feature2 required'),
            'feature2_ar.max'=>__('site.course feature2 max'),
            'discount.numeric'=>__('site.course discount numeric'),
            'duration.required'=>__('site.course feature2 required'),
            'start_date.required'=>__('site.course start date required'),
            'end_date.required'=>__('site.course end date required'),
            'duration.numeric'=>__('site.course duration numeric'),
            'duration.min'=>__('site.course duration min'),
            'duration.max'=>__('site.course duration max'),
            'start_date.required'=>__('site.course start date required'),
            'start_date.date'=>__('site.course start date date'),
            'start_date.after'=>__('site.course start date after'),
            'end_date.required'=>__('site.course end date required'),
            'end_date.date'=>__('site.course end date date'),
            'end_date.after'=>__('site.course end date after'),
            'type.required'=>__('site.course type required'),
            'link.required'=>__('site.course link required'),
            'link_url.required'=>__('site.course link_url required'),
            'link_name.required'=>__('site.course link_name required'),
            'price.required'=>__('site.course price requried'),
            'price.numeric'=>__('site.course price numeric'),
        ];
    }

    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(redirect()->back()->withErrors($validator->errors())->withInput());
    }
}
