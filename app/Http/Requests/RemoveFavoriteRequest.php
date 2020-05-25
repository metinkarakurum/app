<?php

namespace App\Http\Requests;

class RemoveFavoriteRequest extends Request
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
	        'favorite_id'	=> 'required'
        ];
    }

    public function messages()
    {
    	return [
	    	'favorite_id.required'	=> 'favorite_id required',
    	];
    }
}
