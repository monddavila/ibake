<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreProductsRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return true;
    /* if ( !empty(Auth::user()) && Auth::user()->usertype == 1 ) {
      return true;
    }
    return false; */
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, mixed>
   */
  public function rules()
  {
    $rules = [
      'name' => 'required|unique:products|max:255',
      'price' => 'required|min:0',
      'item_description' => 'required|max:255',
      'category' => 'required',
      'image' => ['mimes:jpg,png,jpeg', 'max:5048']
    ];

    if (in_array($this->method(), ['POST'])) {
      $rules['image'] = ['required', 'mimes:jpg,png,jpeg', 'max:5048'];
    }

    return $rules;
  }
}
