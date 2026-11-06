<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('titulo', 'Catálogo') | Zapatería | Administración</title>

    {{-- Bootstrap 5 y Bootstrap Icons desde CDN (no se requiere Node.js) --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    {{-- Barra de navegación --}}
    <nav class="navbar navbar-expand-md navbar-dark navbar-zapateria shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-semibold" href="{{ route('zapatos.index') }}">
                <i class="bi bi-bag-heart-fill me-1"></i> Zapatería <span class="opacity-75">| Administración</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu" aria-controls="menu" aria-expanded="false" aria-label="Mostrar menú">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="menu">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('zapatos.index') ? 'active' : '' }}" href="{{ route('zapatos.index') }}">
                            <i class="bi bi-grid-3x3-gap me-1"></i> Catálogo
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('zapatos.create') ? 'active' : '' }}" href="{{ route('zapatos.create') }}">
                            <i class="bi bi-plus-circle me-1"></i> Registrar zapato
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container py-4">
        {{-- Mensajes de éxito y error --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill me-1"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-1"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
        @endif

        @yield('contenido')
    </main>

    <footer class="text-center text-muted small py-4">
        Zapatería | Administración &middot; {{ date('Y') }}
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
