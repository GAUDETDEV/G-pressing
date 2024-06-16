<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class modifyServiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            "type_service" => "required|min:4",
        ];
    }


    public function messages()
    {
        return[
            "type_service.required" => "Le type de service est requis!",
            "type_service.min" => "Le nom du type de service doit contenir au moins quatre caractères!",
        ];
    }


}
