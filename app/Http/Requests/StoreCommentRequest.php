<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
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
            'subject' => 'required|string|max:25',
            'body' => 'required|string|max:75'
        ];
    }

    public function messages(): array
    {
        return [
            'subject.required' => 'Заголовок комментария обязателен для заполнения',
            'subject.string' => 'Заголовок комментария должен быть строкой.',
            'subject.max' => 'Заголовок комментария не может содержать больше 25 символов.',

            'body.required' => 'Текст комментария обязателен.',
            'body.string' => 'Текст комментария должен быть строкой.',
            'body.max' => 'Текст комментария не может содержать больше 75 символов.',
        ];
    }
}
