<?php

namespace App\Http\Requests;

use App\Models\Zapato;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Validación del formulario de zapatos (se usa al registrar y al editar).
 */
class ZapatoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // No hay módulo de usuarios: cualquiera puede administrar el catálogo.
    }

    public function rules(): array
    {
        return [
            'marca'       => ['required', 'string', 'max:50'],
            'modelo'      => ['required', 'string', 'max:80'],
            'categoria'   => ['required', Rule::in(Zapato::CATEGORIAS)],
            'talla'       => ['required', 'numeric', 'min:22', 'max:31', 'multiple_of:0.5'],
            'color'       => ['required', 'string', 'max:50'],
            'precio'      => ['required', 'numeric', 'gt:0', 'max:99999999.99'],
            'existencias' => ['required', 'integer', 'min:0'],
            'descripcion' => ['nullable', 'string'],
        ];
    }

    /** Mensajes de error en español. */
    public function messages(): array
    {
        return [
            'required'            => 'El campo :attribute es obligatorio.',
            'string'              => 'El campo :attribute debe ser texto.',
            'max'                 =>'El campo :attribute no puede tener más de :max caracteres.',
            'categoria.in'        => 'La categoría debe ser Deportivo, Casual, Formal o Botas.',
            'talla.numeric'       => 'La talla debe ser un número.',
            'talla.min'           => 'La talla mínima es 22.',
            'talla.max'           => 'La talla máxima es 31.',
            'talla.multiple_of'   => 'La talla debe ir en incrementos de 0.5 (por ejemplo 25 o 25.5).',
            'precio.numeric'      => 'El precio debe ser un número.',
            'precio.gt'           => 'El precio debe ser mayor a 0.',
            'precio.max'          => 'El precio es demasiado alto.',
            'existencias.integer' => 'Las existencias deben ser un número entero.',
            'existencias.min'     => 'Las existencias no pueden ser negativas.',
        ];
    }

    /** Nombres legibles de los campos para los mensajes. */
    public function attributes(): array
    {
        return [
            'categoria'   => 'categoría',
            'descripcion' => 'descripción',
        ];
    }
}
