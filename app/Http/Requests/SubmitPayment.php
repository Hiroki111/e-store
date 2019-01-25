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
            'first-name'           => 'required|max:30',
            'last-name'            => 'required|max:30',
            'phone'                => 'required|numeric|max:30',
            'email'                => 'required|email',
            'delivery-address-1'   => 'required|max:255',
            'delivery-suburb'      => 'required|max:255',
            'delivery-state'       => 'required|max:10',
            'delivery-postcode'    => 'required|max:10',
            'use-delivery-address' => 'boolean|required_without_all:billing-address-1,billing-suburb,billing-state,billing-postcode',
            'billing-address-1'    => 'required_if:use-delivery-address,true|max:255',
            'billing-suburb'       => 'required_if:use-delivery-address,true|max:255',
            'billing-state'        => 'required_if:use-delivery-address,true|max:10',
            'billing-postcode'     => 'required_if:use-delivery-address,true|max:10',
            'cc-name'              => 'required|max:30',
            'cc-number'            => 'required|max:16',
            'expiration-mm'        => 'required|max:2',
            'expiration-yy'        => 'required|max:2',
            'csv'                  => 'required|max:3',
            'read-policy'          => 'required|boolean',
        ];
    }
}
