<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'email', 'max:255', 'unique:users,email'],
            'role_id'  => ['required', 'exists:roles,id'],
            'password' => ['som', 'string', 'max:255', 'min:6']
        ];
    }

    public function attributes()
    {
        return [
            'name'    => 'name',
            'email'   => 'email',
            'role_id' => 'roles',
        ];
    }

    public function messages()
    {
        return [
            'name.required'     => 'O campo nome é obrigatório',
            'email.required'    => 'O campo e-mail é obrigatório',
            'role_id.required'  => 'O campo perfil é obrigatório',
            'password.required' => 'O campo senha é obrigatório',
            'password.min'      => 'A senha deve conter ao menos 6 caracteres'
        ];
    }
}
