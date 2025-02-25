<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class SensorRequest extends FormRequest
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
            'model' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
            'status' => 'sometimes',
            'local' => 'required|string|max:255',
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
            'name.required' => 'name is required',
            'name.max' => 'name is too long',
            'model.max' => 'model is too long',
            'local.required' => 'local is required',
            'local.max' => 'local is too long'
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
