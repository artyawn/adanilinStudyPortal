<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'password' => 'required|string',
            'email' => 'required|email|unique:'.User::class,
            'address' => 'array',
            'address.city' => 'required|string',
            'address.street' => 'required|string',
            'address.home' => 'required|int'
        ];
    }
}
