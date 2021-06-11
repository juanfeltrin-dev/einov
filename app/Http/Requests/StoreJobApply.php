<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreJobApply extends FormRequest
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

    public function prepareForValidation()
    {
        $this->merge([
            'salary_claim' => str_replace(
                ',',
                '.',
                str_replace(['R$', '.'], '', $this->salary_claim)
            ),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'curriculum' => 'required|file|mimes:doc,pdf,docx,zip',
            'salary_claim' => 'required',
            'challenge_date' => 'required|date|after:today'
        ];
    }
}
