<?php

namespace App\Http\Controllers;

use App\Http\Requests\ZapatoRequest;
use App\Models\Zapato;
use Illuminate\Http\Request;

class ZapatoController extends Controller
{
    /**
     * Listado del catálogo con buscador, filtro por categoría e indicadores.
     */
    public function index(Request $request)
    {
        $buscar    = trim((string) $request->query('buscar', ''));
        $categoria = (string) $request->query('categoria', '');

        $zapatos = Zapato::query()
            // Buscador por marca o modelo
            ->when($buscar !== '', function ($query) use ($buscar) {
                $query->where(function ($q) use ($buscar) {
                    $q->where('marca', 'like', "%{$buscar}%")
                      ->orWhere('modelo', 'like', "%{$buscar}%");
                });
            })
            // Filtro por categoría (solo si es una categoría válida)
            ->when(in_array($categoria, Zapato::CATEGORIAS, true), fn ($query) => $query->where('categoria', $categoria))
            ->orderByDesc('id')
            ->paginate(10)
            ->withQueryString();

        // Indicadores generales del catálogo (no dependen de la búsqueda)
        $total      = Zapato::count();
        $stockBajo  = Zapato::where('existencias', '<=', Zapato::STOCK_BAJO)->count();
        $agotados   = Zapato::where('existencias', 0)->count();
        $categorias = Zapato::CATEGORIAS;

        return view('zapatos.index', compact('zapatos', 'buscar', 'categoria', 'categorias', 'total', 'stockBajo', 'agotados'));
    }

    /** Formulario de registro. */
    public function create()
    {
        return view('zapatos.create', ['categorias' => Zapato::CATEGORIAS]);
    }

    /** Guarda un nuevo zapato (los datos ya llegan validados por ZapatoRequest). */
    public function store(ZapatoRequest $request)
    {
        $zapato = Zapato::create($request->validated());

        return redirect()->route('zapatos.index')
            ->with('success', "El zapato {$zapato->marca} {$zapato->modelo} se registró correctamente.");
    }

    /** Detalle completo de un zapato. */
    public function show(Zapato $zapato)
    {
        return view('zapatos.show', compact('zapato'));
    }

    /** Formulario de edición con los datos actuales. */
    public function edit(Zapato $zapato)
    {
        return view('zapatos.edit', ['zapato' => $zapato, 'categorias' => Zapato::CATEGORIAS]);
    }

    /** Actualiza un zapato existente. */
    public function update(ZapatoRequest $request, Zapato $zapato)
    {
        $zapato->update($request->validated());

        return redirect()->route('zapatos.show', $zapato)
            ->with('success', 'Los cambios se guardaron correctamente.');
    }

    /** Elimina un zapato. */
    public function destroy(Zapato $zapato)
    {
        $nombre = "{$zapato->marca} {$zapato->modelo}";
        $zapato->delete();

        return redirect()->route('zapatos.index')
            ->with('success', "El zapato {$nombre} se eliminó correctamente.");
    }
}
