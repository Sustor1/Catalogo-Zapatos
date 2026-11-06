{{--
    Formulario compartido por "registrar" y "editar".
    old() conserva lo que escribió el usuario si hubo errores de validación;
    si no, se muestran los datos actuales del zapato (en edición) o vacío (en registro).
--}}
@php($zapato = $zapato ?? null)

<div class="row g-3">
    <div class="col-md-6">
        <label for="marca" class="form-label">Marca <span class="text-danger">*</span></label>
        <input type="text" id="marca" name="marca" maxlength="50" required
               class="form-control @error('marca') is-invalid @enderror"
               value="{{ old('marca', $zapato?->marca) }}">
        @error('marca')<div class="invalid-feedback">{{ $message }}</div>@else<div class="invalid-feedback">La marca es obligatoria (máximo 50 caracteres).</div>@enderror
    </div>

    <div class="col-md-6">
        <label for="modelo" class="form-label">Modelo <span class="text-danger">*</span></label>
        <input type="text" id="modelo" name="modelo" maxlength="80" required
               class="form-control @error('modelo') is-invalid @enderror"
               value="{{ old('modelo', $zapato?->modelo) }}">
        @error('modelo')<div class="invalid-feedback">{{ $message }}</div>@else<div class="invalid-feedback">El modelo es obligatorio (máximo 80 caracteres).</div>@enderror
    </div>

    <div class="col-md-4">
        <label for="categoria" class="form-label">Categoría <span class="text-danger">*</span></label>
        <select id="categoria" name="categoria" required class="form-select @error('categoria') is-invalid @enderror">
            <option value="">Selecciona una categoría</option>
            @foreach ($categorias as $cat)
                <option value="{{ $cat }}" @selected(old('categoria', $zapato?->categoria) === $cat)>{{ $cat }}</option>
            @endforeach
        </select>
        @error('categoria')<div class="invalid-feedback">{{ $message }}</div>@else<div class="invalid-feedback">Selecciona una categoría.</div>@enderror
    </div>

    <div class="col-md-4">
        <label for="talla" class="form-label">Talla (cm) <span class="text-danger">*</span></label>
        <input type="number" id="talla" name="talla" min="22" max="31" step="0.5" required
               class="form-control @error('talla') is-invalid @enderror"
               value="{{ old('talla', $zapato?->talla) }}">
        @error('talla')<div class="invalid-feedback">{{ $message }}</div>@else<div class="invalid-feedback">Talla entre 22 y 31, en incrementos de 0.5.</div>@enderror
    </div>

    <div class="col-md-4">
        <label for="color" class="form-label">Color <span class="text-danger">*</span></label>
        <input type="text" id="color" name="color" maxlength="50" required
               class="form-control @error('color') is-invalid @enderror"
               value="{{ old('color', $zapato?->color) }}">
        @error('color')<div class="invalid-feedback">{{ $message }}</div>@else<div class="invalid-feedback">El color es obligatorio.</div>@enderror
    </div>

    <div class="col-md-6">
        <label for="precio" class="form-label">Precio <span class="text-danger">*</span></label>
        <div class="input-group has-validation">
            <span class="input-group-text">$</span>
            <input type="number" id="precio" name="precio" min="0.01" step="0.01" required
                   class="form-control @error('precio') is-invalid @enderror"
                   value="{{ old('precio', $zapato?->precio) }}">
            @error('precio')<div class="invalid-feedback">{{ $message }}</div>@else<div class="invalid-feedback">El precio debe ser mayor a 0.</div>@enderror
        </div>
    </div>

    <div class="col-md-6">
        <label for="existencias" class="form-label">Existencias <span class="text-danger">*</span></label>
        <input type="number" id="existencias" name="existencias" min="0" step="1" required
               class="form-control @error('existencias') is-invalid @enderror"
               value="{{ old('existencias', $zapato?->existencias) }}">
        @error('existencias')<div class="invalid-feedback">{{ $message }}</div>@else<div class="invalid-feedback">Las existencias deben ser un entero igual o mayor a 0.</div>@enderror
    </div>

    <div class="col-12">
        <label for="descripcion" class="form-label">Descripción <span class="text-muted small">(opcional)</span></label>
        <textarea id="descripcion" name="descripcion" rows="3"
                  class="form-control @error('descripcion') is-invalid @enderror">{{ old('descripcion', $zapato?->descripcion) }}</textarea>
        @error('descripcion')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
</div>
