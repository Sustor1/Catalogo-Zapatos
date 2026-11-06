@extends('layouts.app')

@section('titulo', 'Registrar zapato')

@section('contenido')
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <a href="{{ route('zapatos.index') }}" class="text-decoration-none text-principal small"><i class="bi bi-arrow-left"></i> Volver al catálogo</a>
            <h1 class="h3 mt-2 mb-3">Registrar zapato</h1>

            @if ($errors->any())
                <div class="alert alert-danger"><i class="bi bi-exclamation-triangle-fill me-1"></i> No se pudo registrar el zapato. Revisa los campos marcados.</div>
            @endif

            <div class="card">
                <div class="card-body p-4">
                    <form action="{{ route('zapatos.store') }}" method="POST" class="needs-validation" novalidate>
                        @csrf
                        @include('zapatos._form')

                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <a href="{{ route('zapatos.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-principal"><i class="bi bi-save me-1"></i> Guardar zapato</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
