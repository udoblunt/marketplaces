<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ItemRequest extends Request
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
        $rules = [
            'name' => 'required|string|min:4|max:30',
            'description' => 'required|string|min:10|max:255',
            'by_mail' => 'required|boolean',
        ];
        
        if (!empty($this->request->get('itemPhotos')))
        {
            foreach($this->request->get('itemPhotos') as $key => $val)
            {
                $rules['itemPhotos.'.$key] = 'image';
            }
        }
        
        return $rules;
    }
}
