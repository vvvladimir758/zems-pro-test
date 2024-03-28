<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TimeSpentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
     
        if(request('type')=='add'){
        return [
            'type'        => 'required',
            'time_spent'  => 'required_if:type,==,add|min:5|max:8',
            'description' => 'required|max:400'
        ];
        }
        else{
            return [
                'description' => 'required|max:400'
            ];
        }
    }
    
    public function messages(): array
    {
        return [
            'description.required'    => 'Укажите описание работ',
            'description.max'         => 'Слишком большое описание (до 400 символов)',
            'time_spent'              => 'Укажите время',
        ];
    }
}
