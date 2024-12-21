<?php

namespace App\Http\Requests;

use App\Enums\StatusEnum;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $isUpdate = $this->isMethod('put');
        return [
           'name' => $isUpdate ? 'sometimes|string|max:255' : 'required|string|max:255',
           'email' => $isUpdate ? 'sometimes|email|unique:users,email' :'required|email|unique:users,email',
           'password' => $isUpdate ? 'sometimes|min:8' :'sometimes|min:8',
           'status' => $isUpdate   ? ['sometimes', 'in:' . implode(',', StatusEnum::availableTypes())] : ['required', 'in:' . implode(',', StatusEnum::availableTypes())],
        ];
    }
}
