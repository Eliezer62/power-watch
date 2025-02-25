<?php

namespace App\Http\Requests;

use App\Exceptions\UserCreationException;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

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
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'role' => 'required',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'email' => "email invalid",
            'email.required' => "email is required",
            'email.max' => "email is too long",
            'role.required' => "role is required",
            'name.required' => "name is required",
            'name.max' => "name is too long",
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $msgs = "";
        foreach ($validator->errors()->messages() as $key => $message) {
            $msgs .= ' '.$message[0];
        }

        throw new HttpResponseException(
            response()->json([
                'msg' => 'Validation failed, reason: '. $msgs,
                'status' => 422,
                'timestamp' => Carbon::now()
            ], 422)
        );
    }
}
