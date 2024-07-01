<?php

namespace App\Http\Requests;

// use Illuminate\Support\Facades\Password;
use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class StoreTenancyRegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
    // C:\xampp\htdocs\blog_tenat\app\Http\Requests\StoreTenancyRegisterRequest.php
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // company domain name email password password_confirmation status
        return [
            'company' => 'required|string|max:255',
            'domain' => 'required|string|max:255|unique:domains',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => ['required', 'confirmed', Password::defaults()],
            'status' => 'required|string|max:255',
        ];
    }

    public function prepareForValidation()
    {

        $this->merge([

            'domain' => $this->domain . "." . config('tenancy.central_domains')[1]

        ]);
    }
}
