<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateBlogsRequest extends Request {

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
            'title' => 'required', 
            'date_posted' => 'required', 
            'blogcategories_id' => 'required', 
            'photo_main' => 'required', 
            'description' => 'required', 
            
		];
	}
}
