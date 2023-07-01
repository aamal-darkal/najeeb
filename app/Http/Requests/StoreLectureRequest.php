<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Validator;

class StoreLectureRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'week_program_id' => 'sometimes',
            'subject_id' => 'sometimes',
            'name' => 'required',
            'date' => 'required',
            'video_link' => 'required',
            'duration' => 'required',
            'pdf_file' => 'sometimes|mimes:pdf',
            'pdf_file_name' => 'required_if:pdf_file,!=,null'
        ];
    }

    protected function failedValidation(Validator|\Illuminate\Contracts\Validation\Validator $validator)
    {
        throw new HttpResponseException($this->response($validator->errors()->toArray()));
    }

    protected function response(array $errors)
    {
        // Customize your redirect behavior here
        // For example, redirect to a specific URL or route
        return redirect()->route('create.lecture');
    }

}
