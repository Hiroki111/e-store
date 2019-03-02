<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubmitPayment extends FormRequest
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
            'first_name'           => 'required|max:30',
            'last_name'            => 'required|max:30',
            'phone'                => 'required|max:30',
            'email'                => 'required|email',
            'delivery_address_1'   => 'required|max:255',
            'delivery_suburb'      => 'required|max:255',
            'delivery_state'       => 'required|max:10',
            'delivery_postcode'    => 'required|max:10',
            'use_delivery_address' => 'required_without_all:billing_address_1,billing_suburb,billing_state,billing_postcode',
            'billing_address_1'    => 'required_without:use_delivery_address|max:255',
            'billing_suburb'       => 'required_without:use_delivery_address|max:255',
            'billing_state'        => 'required_without:use_delivery_address|max:10',
            'billing_postcode'     => 'required_without:use_delivery_address|max:10',
            'payment_token'        => 'required',
            'read_policy'          => 'required',
        ];
    }
}
