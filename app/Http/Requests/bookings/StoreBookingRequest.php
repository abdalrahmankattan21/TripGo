<?php

namespace App\Http\Requests\bookings;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class StoreBookingRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'seats' => ['required', 'integer', 'min:1'],
            'companions' => ['array', 'present'],
            'companions.*.name' => ['required', 'string', 'max:255'],
            'companions.*.national_id' => ['nullable', 'string', 'max:50'],
        ];
    }

    public function messages(): array
    {
        return [
            'seats.required' => 'The number of seats is required.',
            'seats.integer' => 'The number of seats must be an integer.',
            'seats.min' => 'The number of seats must be at least 1.',
            'companions.present' => 'Companions are required.',
            'companions.array' => 'Companions must be an array.',
            'companions.*.name.required' => 'Each companion must have a name.',
        ];
    }

   public function withValidator(Validator $validator)
{
    $validator->after(function (Validator $validator) {
        if ($this->has('companions') && count($this->companions) !== $this->seats - 1) {
            $validator->errors()->add(
                'companions',
                'The number of companions must equal the number of seats.'
            );
        }
    });
}
}
