<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
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
            'summary' => 'required|string|max:255',
            'description' => 'nullable|max:1000',
            'priority' => 'nullable|in:low,medium,high', //Must be one of the predefined priorities
            'label' => 'nullable|string|max:100',
            'deadline' => 'nullable|after_or_equal:today', // Must be a valid date, not in the past
            // 'status' => 'required|in:todo,inprogress,done,closed', //Must be one of the predefined statuses
        ];
    }

    public function messages()
    {
        return [
            'summary.required' => 'The task summary is required.',
            'priority.required' => 'The priority is required.',
            'priority.in' => 'The priority must be one of:low, medium, high',
            'deadline.after_or_equal' => 'The deadline cannot be in the past.',
            'status.required' => 'The status is required.',
            //'status.in' => 'The status must be one of: pending, in progress, or completed.',
        ];
    }
}
