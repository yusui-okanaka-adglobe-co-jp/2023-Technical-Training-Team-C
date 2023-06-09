<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
        $latestDate = date("Y", strtotime("1  year")) . '-12-31';
        $rules = [
            'time.start' => 'required|date_format:"Y-m-d"|after_or_equal:2015-01-01|before_or_equal:' . $latestDate,
            'time.end' => 'required|date_format:"Y-m-d"|after_or_equal:time.start|before_or_equal:' . $latestDate,
            'lessons' => 'required|array',
            'lessons.*.subject' => 'exclude_unless:lessons.*.isClear,false|required_with:lessons|string|max:10',
            'lessons.*.teacher' => 'exclude_unless:lessons.*.isClear,false|required_with:lessons|string|max:10',
            'lessons.*.dayOfWeek' => 'required_with:lessons|integer|min:0|max:6',
            'lessons.*.period' => 'required_with:lessons|integer|min:1|max:6',
        ];
        return $rules;
    }


    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors()->all();
        $message = ['validationError'];
        $array = array_merge($message, $errors);
        $response = response()->json([
            'messages' => $array
        ], Response::HTTP_BAD_REQUEST);
        throw new HttpResponseException($response);
    }
}
