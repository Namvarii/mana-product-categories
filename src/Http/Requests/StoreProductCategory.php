<?php

namespace ManaCMS\ManaProductCategories\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductCategory extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string|max:191',
            'slug' => 'required|unique:categories|string|max:100',
            'description' => 'required|string',
            'parent' => 'required',
        ];
    }

    protected function prepareForValidation()
    {
        if ($this->get('slug') == null) {
            $this->merge(['slug'=>str_replace([' ','.'],['-','_'],$this->get('title'))]);
        }
    }
}
