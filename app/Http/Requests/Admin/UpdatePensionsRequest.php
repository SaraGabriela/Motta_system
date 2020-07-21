<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePensionsRequest extends FormRequest
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
            'nombre' => 'required',
            'fecha' => 'nullable',
            'obligatorio' => 'nullable',
            'seguro' => 'nullable',
            'variable' => 'nullable',
            'estado' => 'nullable',
        ];
    }
}
