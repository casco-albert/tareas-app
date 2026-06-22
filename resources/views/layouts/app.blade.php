<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Sistema de Tareas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-dark bg-dark px-3">
    
    <a class="navbar-brand" href="{{ route('tareas.index') }}">
        Sistema de Tareas
    </a>

    @auth
        <div class="d-flex align-items-center gap-2">

            <span class="text-white">
                {{ auth()->user()->name }}
            </span>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-danger btn-sm">
                    Cerrar sesión
                </button>
            </form>

        </div>
    @endauth

    @guest
        <a href="{{ route('login') }}" class="btn btn-primary btn-sm">
            Login
        </a>
    @endguest

</nav>

<div class="container mt-4">

    @yield('contenido')

</div>

</body>
</html>