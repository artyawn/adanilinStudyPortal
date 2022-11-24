<?php

namespace App\Http\Requests;

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
            'subject_id' => 'required|int',
            'score' => 'required|int|max:10',
            ];
    }

    public function isScored($user)
    {
        if ($user->subjects->firstWhere('id', $this->validated('subject_id'))) {
           return redirect()
                ->route('users.subjects.create', $user)
                ->withErrors(['subject' => 'This subject already scored']);
        }
        return null;
    }
}
