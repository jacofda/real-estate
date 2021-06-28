<?php

namespace Areaseb\Estate\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StoreViewRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'client_id' => ['required', Rule::exists('users', 'id')],
            'property_id' => ['required', Rule::exists('properties', 'id')],
            'created_at' => ['required', 'date_format:"d/m/Y H:i"'],
            'note' => ['string', 'nullable']
        ];
    }
}