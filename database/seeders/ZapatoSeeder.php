<?php

namespace Database\Seeders;

use App\Models\Zapato;
use Illuminate\Database\Seeder;

class ZapatoSeeder extends Seeder
{
    /**
     * Registra zapatos de ejemplo que cumplen todas las validaciones.
     */
    public function run(): void
    {
        $zapatos = [
            ['marca' => 'Nike',     'modelo' => 'Air Max 90',          'categoria' => 'Deportivo', 'talla' => 26.5, 'color' => 'Blanco',      'precio' => 2899.00, 'existencias' => 12, 'descripcion' => 'Tenis clásico con cámara de aire visible y suela de goma.'],
            ['marca' => 'Adidas',   'modelo' => 'Ultraboost 22',       'categoria' => 'Deportivo', 'talla' => 27.0, 'color' => 'Negro',       'precio' => 3499.00, 'existencias' => 4,  'descripcion' => 'Calzado para correr con amortiguación Boost.'],
            ['marca' => 'Converse', 'modelo' => 'Chuck Taylor All Star', 'categoria' => 'Casual',  'talla' => 25.0, 'color' => 'Rojo',        'precio' => 1299.00, 'existencias' => 20, 'descripcion' => 'Tenis de lona de bota baja, estilo clásico.'],
            ['marca' => 'Vans',     'modelo' => 'Old Skool',           'categoria' => 'Casual',    'talla' => 24.5, 'color' => 'Negro/Blanco', 'precio' => 1499.00, 'existencias' => 0,  'descripcion' => 'Tenis de skate con franja lateral característica.'],
            ['marca' => 'Flexi',    'modelo' => 'Oxford 402',          'categoria' => 'Formal',    'talla' => 27.5, 'color' => 'Café',        'precio' => 1899.00, 'existencias' => 8,  'descripcion' => 'Zapato de piel tipo Oxford con suela flexible.'],
            ['marca' => 'Andrea',   'modelo' => 'Stiletto Clásico',    'categoria' => 'Formal',    'talla' => 23.5, 'color' => 'Nude',        'precio' => 999.00,  'existencias' => 3,  'descripcion' => 'Zapatilla de tacón alto para ocasiones especiales.'],
            ['marca' => 'Timberland', 'modelo' => '6-Inch Premium',    'categoria' => 'Botas',     'talla' => 28.0, 'color' => 'Trigo',       'precio' => 4299.00, 'existencias' => 6,  'descripcion' => 'Bota impermeable de piel nobuk.'],
            ['marca' => 'Dr. Martens', 'modelo' => '1460',             'categoria' => 'Botas',     'talla' => 26.0, 'color' => 'Negro',       'precio' => 3899.00, 'existencias' => 0,  'descripcion' => 'Bota de 8 ojillos con suela AirWair.'],
            ['marca' => 'Puma',     'modelo' => 'Suede Classic',       'categoria' => 'Casual',    'talla' => 29.5, 'color' => 'Azul marino', 'precio' => 1699.00, 'existencias' => 15, 'descripcion' => null],
            ['marca' => 'Brantano', 'modelo' => 'Mocasín Ejecutivo',   'categoria' => 'Formal',    'talla' => 30.5, 'color' => 'Negro',       'precio' => 1599.00, 'existencias' => 5,  'descripcion' => 'Mocasín de piel para uso diario en oficina.'],
        ];

        foreach ($zapatos as $zapato) {
            Zapato::create($zapato);
        }
    }
}
