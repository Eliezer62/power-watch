<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ReportRequest extends FormRequest
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
            'voltage' => 'required|numeric|between:-1.0,1000.0',
            'sensor_id' => 'required|uuid|exists:sensors,id',
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
            'voltage.required' => 'voltage is required',
            'voltage.between' => 'voltage must be between:-1.0,1000.0',
            'sensor_id.required' => 'sensor_id is required',
            'sensor_id.exists' => 'sensor dont exist',
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
