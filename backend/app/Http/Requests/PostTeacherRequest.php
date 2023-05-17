<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class PostTeacherRequest extends FormRequest
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
            'email' => 'required|email|max:255',
            'password' => 'required|string|between:8,255',
        ];
    }


    protected function failedValidation(Validator $validator)
    {
        $message = [
            'messages' => [
                'failure'
            ]
        ];
        $response = response()->json($message, Response::HTTP_BAD_REQUEST);
        throw new HttpResponseException($response);
    }
}
