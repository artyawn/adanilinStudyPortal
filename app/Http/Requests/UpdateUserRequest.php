<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
            'fio' => 'required|string|max:100',
            'birth_date' => 'required|date',
            'group_id' => 'required|int',
            'role' => 'required|int',
            'avatar' => 'sometimes|image:jpg,jpeg,png',
            'email' => [
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user->id)
            ],
            'address' => 'array',
            'address.city' => 'required|string',
            'address.street' => 'required|string',
            'address.home' => 'required|int'
        ];
    }
}
