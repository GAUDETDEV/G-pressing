<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class tachePostRequest extends FormRequest
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
            "debut_tache" => "required",
            "fin_tache" => "required",
        ];
    }

    public function messages()
    {
        return [
            'debut_tache.required' => 'Définissez une période de debut de la tâche!',
            'fin_tache.required' => 'Définissez une période de fin de la tâche!',
        ];
    }


}
