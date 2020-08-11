<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreManifestCustomersRequest extends FormRequest
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
            'name' => 'required|unique:manifest_customers,name', 
            'ruc' => 'required|unique:manifest_customers,ruc',
            'contact_phone' => 'nullable', 
            'contact_name' => 'nullable',
            'id_sector' => 'required',         
        ];
    }
}
