<?php

namespace App\Http\Requests;

use App\Rules\isScored;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserSubjectRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'score' => 'required|int|max:10',
            'subject_id' => [
                'required',
                'int',
                new isScored($this->user->id)
            ]
        ];
    }

}
