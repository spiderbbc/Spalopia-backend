<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservaServicioPostRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        
        return [
            'nombre_cliente' => 'required|max:45|min:3',
            'email_cliente' => 'required|email',
            'dia_servicio' => 'required|date',
            'hora_servicio' => 'required|date_format:H:i:s',
            'servicio_id' => 'required|int',
            'precio_reserva' => 'required|numeric|between:0,99.99'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            // nombre_cliente
            'nombre_cliente.required'    => 'El nombre es requerido.',
            'nombre_cliente.max'       => 'El nombre supera el max caracteres permitidos.',
            'nombre_cliente.min'       => 'El nombre no supera el minimo caracteres.',
            // nombre_cliente
            'email_cliente.required'    => 'El email cliente es requerido.',
            'email_cliente.email'       => 'El email_cliente no tiene formato email',
            // dia_servicio
            'dia_servicio.required'    => 'El dia servicio es requerido.',
            'dia_servicio.date'       => 'El dia servicio no tiene formato date',
            // hora_servicio
            'hora_servicio.required'    => 'El hora servicio es requerido.',
            'hora_servicio.date_format'       => 'El hora servicio no tiene formato H:i:s',
            // servicio_id
            'servicio_id.required'    => 'El servicio id es requerido.',
            'servicio_id.int'       => 'El servicio id no tiene formato numerico',
            // precio_reserva
            'precio_reserva.required'    => 'El precio reserva es requerido.',

        ];
    }
}
