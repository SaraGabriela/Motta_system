<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAsistenciasRequest extends FormRequest
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
            'worker_id' => 'required',
            'dias_vacaciones' => 'nullable',
            'descanso_medico' => 'nullable',
            'horas_extra_25' => 'nullable',
            'horas_extra_35' => 'nullable',
            'horas_extra_100' => 'nullable',
        ];
    }
}
