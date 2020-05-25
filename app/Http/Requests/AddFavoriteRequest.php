<?php

namespace App\Http\Requests;

class AddFavoriteRequest extends Request
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
	        'song_id'	=> 'required'
        ];
    }

    public function messages()
    {
    	return [
	    	'song_id.required'	=> 'song_id required',
    	];
    }
}
