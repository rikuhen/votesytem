<?php

namespace App\Http\Requests;

use App\Http\Requests\ValidationInterface;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ListVoteRequest extends FormRequest implements ValidationInterface
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
        if ($this->method() == 'POST') {
            return $this->validateOnSave();
        } else {
            return $this->validateOnUpdate();
        }
    }

    public function validateOnSave()
    {
        return [
            'name' => 'required|string|max:50|unique:list_votes',
            'description' => 'required',
            'enabled' => 'boolean',
            'type' => 'in:regular,nulled,white',
            'img_path' => 'file|mimes:jpg,jpeg,gif,png|size:2048',
        ];
    }

    public function validateOnUpdate()
    {
        $rules = $this->validateOnSave();
        $listId = $this->route('list');
        $rules['name'] = ['required', 'string', 'max:50', Rule::unique('list_votes')->ignore($listId)];
        return $rules;
    }
}
