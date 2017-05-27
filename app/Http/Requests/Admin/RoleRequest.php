<?php

namespace App\Http\Requests\Admin;

use App\Models\role;
use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest {
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
      if($this->segment(3)!="") {
        $role = Role::find($this->segment(3));
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
            'name' => 'required|min:2',
            'display_name' => 'required|min:2',
          ];
        }
        case 'PUT':
        case 'PATCH':
        {
          return [
            'name' => 'required|min:2',
            'display_name' => 'required|min:2',
          ];
        }
        default:break;
      }
    }
}
