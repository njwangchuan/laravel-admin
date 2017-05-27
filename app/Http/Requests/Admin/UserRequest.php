<?php namespace App\Http\Requests\Admin;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest {

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		if($this->segment(3)!="") {
			$user = User::find($this->segment(3));
		}

		switch($this->method())
		{
			case 'GET':
			case 'DELETE':
			{
				return [];
			}
			case 'POST':
			{
				return [
					'username' => 'required|min:8',
					'display_name' => 'min:4|unique:users',
					'email' => 'email|unique:users',
					'phone' => 'phone:CN,mobile',
					'password' => 'required',
				];
			}
			case 'PUT':
			case 'PATCH':
			{
				return [
					'username' => 'required|min:8',
					'display_name' => 'min:4|unique:users,display_name,'.$user->id,
					'email' => 'email|unique:users,email,'.$user->id,
					'phone' => 'phone:CN,mobile|unique:users,phone,'.$user->id,
				];
			}
			default:break;
		}
	}

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

}
