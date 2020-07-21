<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreWorkersRequest extends FormRequest
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
            'nombre_del_trabajador' => 'required',
            'documento_indentificacion' => 'required',
            'banco' => 'required',
            'cussp' => 'required',
            'cuenta_sueldo' => 'required',
            'cuenta_interbancaria' => 'required',
            'cuenta_viaticos' => 'required',
            'fecha_de_ingreso' => 'required',
            'fecha_de_cese' => 'nullable|date',
        ];
    }
}
