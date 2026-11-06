{{-- Insignia de existencias: rojo si está agotado, amarillo si hay 5 o menos, verde en otro caso --}}
@if ($existencias === 0)
    <span class="badge text-bg-danger">Agotado</span>
@elseif ($existencias <= \App\Models\Zapato::STOCK_BAJO)
    <span class="badge text-bg-warning">{{ $existencias }} · Pocas</span>
@else
    <span class="badge text-bg-success">{{ $existencias }}</span>
@endif
