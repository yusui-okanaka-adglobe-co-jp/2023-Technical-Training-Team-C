<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

// use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;


class RegisterPostRequest extends FormRequest
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
            'time.start' => 'required|date_format:"Y-m-d"',
            'time.end' => 'required|date_format:"Y-m-d"',
            'lessons' => 'required|array',
            'lessons.*.subject' => 'required_with:lessons.*.subject|string|max:10',
            'lessons.*.teacher' => 'required_with:lessons.*.teacher|string|max:10',
            'lessons.*.dayOfWeek' => 'required_with:lessons.*.dayOfWeek|min:0|max:6',
            'lessons.*.period' => 'required_with:lessons.*.period|min:1|max:6'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $response = response()->json([
            // 'status' => Response::HTTP_BAD_REQUEST,
            // 'errors' => $validator->errors(),
            'messages' => [
                'validationError',
                $validator->errors(),
            ]
        ], Response::HTTP_BAD_REQUEST);
        throw new HttpResponseException($response);
    }
}
