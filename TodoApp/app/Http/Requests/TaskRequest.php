<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

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
    public function rules(Request $request): array
    {
        $rules = [
            'title' => 'required|max:255',
            'body' => 'required',
            'priority' => 'required',
            'deadline' => 'required|date',
        ];
        if($request->has('status')){
            $rules['status'] = 'required';
        }
        if($request->has('categories')){
            $rules['categories'] = 'required|array';
            $rules['categories.*'] = 'required|integer|exists:categories,id';
        }
        if ($request->has('tags')) {
            $rules['tags'] = 'required|array';
            $rules['tags.*'] = 'required|integer|exists:tags,id';
        }
        if ($request->hasFile('path')) {
            $rules['path'] = 'required|file|mimes:jpg,jpeg,png|max:2048';
        }

        return $rules;
    }
}
