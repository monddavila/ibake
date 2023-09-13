<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrdersRequest extends FormRequest
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
   * @return array<string, mixed>
   */
  public function rules()
  {
    $rules = [
      'recipient_name' => 'required|max:255',
      'street_address' => 'required|max:255',
      'town' => 'required|max:255',
      'province' => 'required|max:255',
      'postcode' => 'required|max:255',
      'recipient_email' => 'required|max:255',
      'recipient_phone' => 'required|max:255',
      'delivery_date' => 'required',
      'delivery_time' => 'required',
      'payment_method' => 'required|max:255'
    ];

    return $rules;
  }
}
