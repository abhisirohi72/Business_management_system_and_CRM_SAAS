<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\Task;
use Illuminate\Validation\Rule;

class UpdateTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('create', Task::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'project_id' => [
                'required', 
                Rule::exists('projects', 'id')
                    ->where('company_id', $this->user()->company_id)
            ],
            'assigned_to' => [
                'nullable', 
                Rule::exists('users', 'id')
                    ->where('company_id', $this->user()->company_id)
            ],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'status' => [
                'nullable',
                'in:pending,in_progress,completed,on_hold,cancelled'
            ],
            'priority' => [
                'nullable',
                'in:low,medium,high,urgent'
            ],
            'start_date' => ['nullable', 'date'],
            'due_date' => ['nullable', 'date', 'after_or_equal:start_date'],
        ];
    }
}
