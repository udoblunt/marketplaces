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
        //Rules used by step one (atleast one market is required, this is checked in the ItemController)
        if ($this->request->get('next')) $rules = [];
        //Rules used by step two
        if ($this->request->get('save'))
        {
            $rules = [
            'name' => 'required|string|min:4|max:30',
            'description' => 'required|string|min:10|max:255',
            'price' => 'required|string',
            ];
            //Rules for the itemAttributes of the market the user is trying to add in
            foreach($this->request->get('itemAttributes') as $key => $val)
            {
                $rules['itemAttributes.'.$key] = 'required|string';
            }
            
            //Photos get validated in the ItemController cause of bad luck doing it here
            //MUST STILL BE WRITTEN
            
            $rules = [];
        }
        
        return $rules;
    }
}
