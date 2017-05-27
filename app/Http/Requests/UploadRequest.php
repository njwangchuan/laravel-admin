<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class UploadRequest extends FormRequest
{
  /**
  * Get the validation rules that apply to the request.
  *
  * @return array
  */
  public function rules()
  {
    switch ($this->method()) {
      case 'GET':
      case 'DELETE':
      {
        return [];
      }
      case 'POST':
      {
        return [
          'type' => 'required',
          'photo' => 'image|mimes:png,jpg,jpeg,gif,bmp',
          'logo' => 'image|mimes:png,jpg,jpeg,gif,bmp',
          'banner' => 'image|mimes:png,jpg,jpeg,gif,bmp',
        ];
      }
      case 'PUT':
      case 'PATCH':
      {
        return [
          'type' => 'required',
          'photo' => 'image|mimes:png,jpg,jpeg,gif,bmp',
          'logo' => 'image|mimes:png,jpg,jpeg,gif,bmp',
          'banner' => 'image|mimes:png,jpg,gif,jpeg,bmp',
        ];
      }
      default:break;
    }
  }

  /**
  * Determine if the category is authorized to make this request.
  *
  * @return bool
  */
  public function authorize()
  {
    return true;
  }

  protected function formatErrors(Validator $validator)
  {
    return $validator->errors()->all();
  }
}
