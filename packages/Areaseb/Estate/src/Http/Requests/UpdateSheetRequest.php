<?php

namespace Areaseb\Estate\Http\Requests;

use Areaseb\Estate\Models\Sheet;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateSheetRequest extends FormRequest
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
        // We are using the model binding here
        $sheet = $this->route('sheet');

        return [
            'view' => ['required', 'min:1'],
            'view.*' => [
                Rule::exists('property_views', 'id')
                    ->where('client_id', $sheet->client->id)
                    ->where(function ($query) use ($sheet) {
                        return $query->whereNull('property_sheet_id')
                            ->orWhere('property_sheet_id', $sheet->id);
                    })
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
