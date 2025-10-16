<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IssueRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'code' => 'required|string|unique:issues,code',
            'status' => '|sometimes|required|in:open,closed',
            'priority' => 'required|in:low,medium,high,urgent',
            'project_id' => 'required|exists:projects,id',
            'reporter_id' => 'required|exists:users,id',
            'assignee_ids' => 'nullable|array',
            'assignee_ids.*' => 'exists:users,id',
            'label_ids' => 'required|array|min:1',
            'label_ids.*' => 'exists:labels,id',
            'due_window' => 'nullable|array',
            'due_window.start' => 'required_with:due_window|date',
            'due_window.end' => 'required_with:due_window|date|after:due_window.start',

        ];
    }
}
