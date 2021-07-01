<?php

namespace Areaseb\Estate\Http\Requests;

use Areaseb\Estate\Rules\OnePrivacyPerUser;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StorePrivacyRequest extends FormRequest
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
            'client_id' => [
                'required',
                Rule::exists('clients', 'id'),
                new OnePrivacyPerUser()
            ]
        ];
    }

    public function attributes()
    {
        return [
            'client_id' => 'cliente',
            'view' => 'visita',
            'view.*' => 'visita'
        ];
    }
}
