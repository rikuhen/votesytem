<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class DignityRequest extends FormRequest implements ValidationInterface
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
            'name' => 'required|string|max:50|unique:dignities',
            'mode_vote' => 'required|in:list,candidate',
            'state' => 'required|boolean',
        ];
    }

    public function validateOnUpdate()
    {
        $rules = $this->validateOnSave();
        $dignity = $this->route('dignity');
        $rules['name'] = ['required', 'string', 'max:50', Rule::unique('dignities')->ignore($dignity)];
        return $rules;

    }
}
