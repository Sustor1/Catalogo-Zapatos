@extends('layouts.app')

@section('titulo', $zapato->marca . ' ' . $zapato->modelo)

@section('contenido')
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <a href="{{ route('zapatos.index') }}" class="text-decoration-none text-principal small"><i class="bi bi-arrow-left"></i> Volver al catálogo</a>

            <div class="card mt-2">
                <div class="card-header bg-white d-flex flex-wrap justify-content-between align-items-center gap-2 py-3">
                    <div>
                        <span class="badge badge-categoria mb-1">{{ $zapato->categoria }}</span>
                        <h1 class="h4 mb-0">{{ $zapato->marca }} {{ $zapato->modelo }}</h1>
                    </div>
                    <div class="d-flex gap-2">
                        <a href="{{ route('zapatos.edit', $zapato) }}" class="btn btn-outline-principal"><i class="bi bi-pencil me-1"></i> Editar</a>
                        <form action="{{ route('zapatos.destroy', $zapato) }}" method="POST" class="form-eliminar" data-nombre="{{ $zapato->marca }} {{ $zapato->modelo }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger"><i class="bi bi-trash me-1"></i> Eliminar</button>
                        </form>
                    </div>
                </div>
                <div class="card-body p-4">
                    <dl class="row mb-0 detalle">
                        <dt class="col-sm-4">ID</dt>
                        <dd class="col-sm-8">{{ $zapato->id }}</dd>

                        <dt class="col-sm-4">Marca</dt>
                        <dd class="col-sm-8">{{ $zapato->marca }}</dd>

                        <dt class="col-sm-4">Modelo</dt>
                        <dd class="col-sm-8">{{ $zapato->modelo }}</dd>

                        <dt class="col-sm-4">Categoría</dt>
                        <dd class="col-sm-8">{{ $zapato->categoria }}</dd>

                        <dt class="col-sm-4">Talla</dt>
                        <dd class="col-sm-8">{{ $zapato->talla }}</dd>

                        <dt class="col-sm-4">Color</dt>
                        <dd class="col-sm-8">{{ $zapato->color }}</dd>

                        <dt class="col-sm-4">Precio</dt>
                        <dd class="col-sm-8 fw-semibold">${{ number_format($zapato->precio, 2) }}</dd>

                        <dt class="col-sm-4">Existencias</dt>
                        <dd class="col-sm-8">@include('zapatos._existencias', ['existencias' => $zapato->existencias])</dd>

                        <dt class="col-sm-4">Descripción</dt>
                        <dd class="col-sm-8">{{ $zapato->descripcion ?: 'Sin descripción.' }}</dd>

                        <dt class="col-sm-4">Fecha de registro</dt>
                        <dd class="col-sm-8">{{ $zapato->created_at?->format('d/m/Y H:i') }}</dd>

                        <dt class="col-sm-4">Última edición</dt>
                        <dd class="col-sm-8">{{ $zapato->updated_at?->format('d/m/Y H:i') }}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
@endsection
