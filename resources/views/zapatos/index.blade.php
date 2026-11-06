@extends('layouts.app')

@section('titulo', 'Catálogo')

@section('contenido')
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
        <div>
            <h1 class="h3 mb-0">Catálogo de zapatos</h1>
            <p class="text-muted mb-0">Administra el inventario de la zapatería.</p>
        </div>
        <a href="{{ route('zapatos.create') }}" class="btn btn-principal">
            <i class="bi bi-plus-lg me-1"></i> Registrar zapato
        </a>
    </div>

    {{-- Indicadores --}}
    <div class="row g-3 mb-4">
        <div class="col-12 col-md-4">
            <div class="card indicador h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="indicador-icono bg-principal-suave text-principal"><i class="bi bi-box-seam"></i></div>
                    <div>
                        <div class="text-muted small">Zapatos registrados</div>
                        <div class="fs-3 fw-bold" id="total-zapatos">{{ $total }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card indicador h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="indicador-icono bg-warning-subtle text-warning-emphasis"><i class="bi bi-exclamation-circle"></i></div>
                    <div>
                        <div class="text-muted small">Pocas existencias (5 o menos)</div>
                        <div class="fs-3 fw-bold" id="stock-bajo">{{ $stockBajo }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card indicador h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="indicador-icono bg-danger-subtle text-danger"><i class="bi bi-x-octagon"></i></div>
                    <div>
                        <div class="text-muted small">Agotados (0 existencias)</div>
                        <div class="fs-3 fw-bold" id="agotados">{{ $agotados }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        {{-- Buscador y filtro --}}
        <div class="card-header bg-white py-3">
            <form method="GET" action="{{ route('zapatos.index') }}" class="row g-2 align-items-center">
                <div class="col-12 col-md-6">
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
                        <input type="text" name="buscar" value="{{ $buscar }}" class="form-control" placeholder="Buscar por marca o modelo...">
                    </div>
                </div>
                <div class="col-8 col-md-3">
                    <select name="categoria" class="form-select" aria-label="Filtrar por categoría">
                        <option value="">Todas las categorías</option>
                        @foreach ($categorias as $cat)
                            <option value="{{ $cat }}" @selected($categoria === $cat)>{{ $cat }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-4 col-md-3 d-flex gap-2">
                    <button type="submit" class="btn btn-principal flex-fill"><i class="bi bi-funnel me-1"></i> Filtrar</button>
                    @if ($buscar !== '' || $categoria !== '')
                        <a href="{{ route('zapatos.index') }}" class="btn btn-outline-secondary" title="Limpiar filtros"><i class="bi bi-x-lg"></i></a>
                    @endif
                </div>
            </form>
        </div>

        {{-- Tabla del catálogo --}}
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Categoría</th>
                        <th class="text-center">Talla</th>
                        <th>Color</th>
                        <th class="text-end">Precio</th>
                        <th class="text-center">Existencias</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($zapatos as $zapato)
                        <tr>
                            <td class="text-muted">{{ $zapato->id }}</td>
                            <td class="fw-semibold">{{ $zapato->marca }}</td>
                            <td>{{ $zapato->modelo }}</td>
                            <td><span class="badge badge-categoria">{{ $zapato->categoria }}</span></td>
                            <td class="text-center">{{ $zapato->talla }}</td>
                            <td>{{ $zapato->color }}</td>
                            <td class="text-end">${{ number_format($zapato->precio, 2) }}</td>
                            <td class="text-center">@include('zapatos._existencias', ['existencias' => $zapato->existencias])</td>
                            <td class="text-end text-nowrap">
                                <a href="{{ route('zapatos.show', $zapato) }}" class="btn btn-sm btn-outline-secondary" title="Ver detalles"><i class="bi bi-eye"></i></a>
                                <a href="{{ route('zapatos.edit', $zapato) }}" class="btn btn-sm btn-outline-principal" title="Editar"><i class="bi bi-pencil"></i></a>
                                <form action="{{ route('zapatos.destroy', $zapato) }}" method="POST" class="d-inline form-eliminar" data-nombre="{{ $zapato->marca }} {{ $zapato->modelo }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Eliminar"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center text-muted py-5">
                                <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                No se encontraron zapatos con los criterios indicados.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($zapatos->hasPages())
            <div class="card-footer bg-white d-flex justify-content-center pt-3">
                {{ $zapatos->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>
@endsection
