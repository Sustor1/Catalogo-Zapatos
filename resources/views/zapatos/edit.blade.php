@extends('layouts.app')

@section('titulo', 'Editar zapato')

@section('contenido')
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <a href="{{ route('zapatos.show', $zapato) }}" class="text-decoration-none text-principal small"><i class="bi bi-arrow-left"></i> Volver a los detalles</a>
            <h1 class="h3 mt-2 mb-3">Editar zapato <span class="text-muted fs-5">#{{ $zapato->id }}</span></h1>

            @if ($errors->any())
                <div class="alert alert-danger"><i class="bi bi-exclamation-triangle-fill me-1"></i> No se pudieron guardar los cambios. Revisa los campos marcados.</div>
            @endif

            <div class="card">
                <div class="card-body p-4">
                    <form action="{{ route('zapatos.update', $zapato) }}" method="POST" class="needs-validation" novalidate>
                        @csrf
                        @method('PUT')
                        @include('zapatos._form', ['zapato' => $zapato])

                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <a href="{{ route('zapatos.show', $zapato) }}" class="btn btn-outline-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-principal"><i class="bi bi-save me-1"></i> Guardar cambios</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
