<?php

namespace Areaseb\Estate\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StoreSheetRequest extends FormRequest
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
        $clientId = $this->input('client_id');
        return [
            'client_id' => ['required', Rule::exists('users', 'id')],
            'view' => ['required', 'min:1'],
            'view.*' => [
                Rule::exists('property_views', 'id')
                    ->where('client_id', $clientId)
                    ->whereNull('property_sheet_id')
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
