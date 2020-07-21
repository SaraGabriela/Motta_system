<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateManifestsRequest extends FormRequest
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
            'document_type' => 'required',
            'attached' => 'required',
            'creation_date' => 'required',
            'pick_date' => 'required',
            'id_user ' => 'required',
            'id_customer' => 'required',
        ];
    }
}