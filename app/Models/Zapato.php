<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Zapato extends Model
{
    /** Nombre explícito de la tabla (evita la pluralización en inglés). */
    protected $table = 'zapatos';

    /** Categorías permitidas para un zapato. */
    public const CATEGORIAS = ['Deportivo', 'Casual', 'Formal', 'Botas'];

    /** Límite para considerar que un producto tiene pocas existencias. */
    public const STOCK_BAJO = 5;

    /** Campos que se pueden asignar desde los formularios. */
    protected $fillable = [
        'marca',
        'modelo',
        'categoria',
        'talla',
        'color',
        'precio',
        'existencias',
        'descripcion',
    ];

    protected $casts = [
        'talla'       => 'decimal:1',
        'precio'      => 'decimal:2',
        'existencias' => 'integer',
    ];
}
