<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class DefaultAttributeRequest extends Request
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
        foreach($this->request->get('defaultAttributeNames') as $key => $val)
        {
            $rules['defaultAttributeNames.'.$key] = 'string|min:4|max:20';
        }
        
        return $rules;
    }
}
