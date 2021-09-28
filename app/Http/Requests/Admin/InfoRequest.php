<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class InfoRequest extends FormRequest
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
            if($request->key_word == 'basic'){
                return [
                    'logo'=>'required|image|mimes:jpg,png,jpeg',
                    'favicon'=>'required|image|mimes:jpg,png,jpeg',
                    'name_ar'=>'required|string|max:100',
                    'name_en'=>'nullable|string|max:100',
                    'name2_ar'=>'nullable|string|max:100',
                    'name2_en'=>'nullable|string|max:100',
                    'hint_ar'=>'required|string|max:500',
                    'hint_en'=>'nullable|string|max:500',
                    'hint2_ar'=>'nullable|string|max:150',
                    'hint2_en'=>'nullable|string|max:150',
                    'whatsapp_male'=>'nullable|numeric',
                    'whatsapp_female'=>'nullable|numeric',
                ];
            }elseif($request->key_word == 'social'){
                return [
                    'fb'=>'nullable|max:191',
                    'tw'=>'nullable|max:191',
                    'insta'=>'nullable|max:191',
                    'google'=>'nullable|max:191',
                ];
            }elseif($request->key_word == 'pages'){
                return [
                    'aboutus_ar'=>'required',
                    'aboutus_en'=>'nullable',
                    'our_vision_ar'=>'required',
                    'ourmessage_ar'=>'required',
                    'ourmessage_en'=>'nullable',
                    'assembly_classification_ar'=>'required',
                    'assembly_classification_en'=>'nullable',
                    'our_vision_en'=>'nullable',
                    'goal1_ar'=>'required',
                    'goal2_ar'=>'required',
                    'goal3_ar'=>'required',
                    'goal1_en'=>'nullable',
                    'goal2_en'=>'nullable',
                    'goal3_en'=>'nullable',
                    'script1'=>'required',
                    'script2'=>'required',
                    'year'=>'nullable|digits:4|integer|min:1900|max:'.(date('Y')+1),
                ];
            }


    }

    public function messages()
    {
        return [
            'logo.required'=>__('site.info logo required'),
            'logo.image'=>__('site.info logo image'),
            'logo.mimes'=>__('site.info logo mimes'),
            'favicon.required'=>__('site.info favicon required'),
            'favicon.image'=>__('site.info favicon image'),
            'favicon.mimes'=>__('site.info favicon mimes'),
            'name_ar.required'=>__('site.info arabic name required'),
            'name_ar.max'=>__('site.info arabic name max'),
            'name_en.required'=>__('site.info english name required'),
            'name_en.max'=>__('site.info english name max'),
            'name2_ar.required'=>__('site.info second arabic name required'),
            'name2_ar.max'=>__('site.info second arabic name max'),
            'name2_en.required'=>__('site.info second english name required'),
            'name2_en.max'=>__('site.info second english name max'),
            'name2_ar.required'=>__('site.info second arabic name required'),
            'hint_ar.required'=>__('site.info arabic hint required'),
            'hint_ar.max'=>__('site.info english hint max'),
            'hint_en.required'=>__('site.info english hint required'),
            'hint_en.max'=>__('site.info second english name max'),
            'hint2_ar.required'=>__('site.info second arabic  hint required'),
            'hint2_ar.max'=>__('site.info arabic hint max'),
            'hint2_en.required'=>__('site.info second english hint required'),
            'hint2_en.max'=>__('site.info second english name max'),
            'whatsapp_male.required'=>__('site.info whatsapp male required'),
            'whatsapp_female.required'=>__('site.info whatsapp female required'),
            'whatsapp_male.numeric'=>__('site.info whatsapp male numeric'),
            'whatsapp_female.numeric'=>__('site.info whatsapp female numeric'),
            // ---- Social ----
            'fb'=>__('site.info fb max'),
            'tw'=>__('site.info tw max'),
            'insta'=>__('site.info insta max'),
            'google'=>__('site.info google max'),
            // ---- Pages ----
            'aboutus_ar'=>__('site.info arabic aboutus required'),
            'aboutus_en'=>__('site.info english aboutus required'),
            'our_vision_ar'=>__('site.info arabic our_vision required'),
            'our_vision_en'=>__('site.info english our_vision required'),
            'goal1_ar'=>__('site.info arabic goal1 required'),
            'goal2_ar'=>__('site.info arabic goal2 required'),
            'goal3_ar'=>__('site.info arabic goal3 required'),
            'goal1_en'=>__('site.info english goal1 required'),
            'goal2_en'=>__('site.info english goal2 required'),
            'goal3_en'=>__('site.info english goal3 required'),
            'script1'=>__('site.info script1 required'),
            'script2'=>__('site.info script2 required'),

            'ourmessage_ar.required'=>__('site.info arabic ourmessage'),
            // 'ourmessage_en.required'=>__('site.info english ourmessage'),
            'assembly_classification_ar.required'=>__('site.info arabic assembly classification'),
            // 'assembly_classification_en.required'=>__('site.info english assembly classification'),
            'year.min'=>__('site.info minimum year experts'),
            'year.digits'=>__('site.info year experts digits'),
            'year.max'=>__('site.info maximum year experts'),
        ];
    }

    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(redirect()->back()->withErrors($validator->errors())->withInput());
    }
}
