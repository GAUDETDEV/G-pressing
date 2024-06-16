<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class optQualityVetPostRequest extends FormRequest
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
            'nom' => "required|max:15",
        ];
    }


    public function messages()
    {

        return [

            "nom.required" => "Le type est requis!",
            "nom.max" => "Le type doit contenir au maximum quinze (15) caractères!",

        ];

    }


}
