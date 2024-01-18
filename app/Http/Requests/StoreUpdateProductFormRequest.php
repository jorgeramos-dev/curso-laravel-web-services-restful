<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateProductFormRequest extends FormRequest
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
        $id = $this->segment(3);
        
        return [
            'category_id' => 'required|exists:catefories,id',
            'name' => "required|min:3|max:100|unique:products,name,{$id},id",
            'description' => 'max:1000',
            'image' => 'image',
        ];
    }
}
