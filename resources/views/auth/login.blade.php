<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container py-5">

    <div class="row justify-content-center">
        <div class="col-12 col-sm-10 col-md-7 col-lg-5">

            <div class="card shadow-sm border-0">

                <div class="card-header bg-primary text-white text-center">
                    <h4 class="mb-0">Iniciar sesión</h4>
                </div>

                <div class="card-body p-4">

                    {{-- ERRORES --}}
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <strong>Error:</strong> {{ $errors->first() }}
                        </div>
                    @endif

                    <form method="POST" action="{{ url('/login') }}">
                        @csrf

                        {{-- EMAIL --}}
                        <div class="mb-3">
                            <label class="form-label">Correo electrónico</label>
                            <input type="email"
                                   name="email"
                                   class="form-control"
                                   placeholder="ejemplo@email.com"
                                   value="{{ old('email') }}"
                                   required>
                        </div>

                        {{-- PASSWORD --}}
                        <div class="mb-3">
                            <label class="form-label">Contraseña</label>
                            <input type="password"
                                   name="password"
                                   class="form-control"
                                   placeholder="Ingresa tu contraseña"
                                   required>
                        </div>

                        {{-- RECORDARME --}}
                        <div class="form-check mb-3">
                            <input type="checkbox"
                                   name="remember"
                                   class="form-check-input"
                                   id="remember">

                            <label class="form-check-label" for="remember">
                                Recordarme
                            </label>
                        </div>

                        {{-- BOTÓN --}}
                        <button class="btn btn-primary w-100 py-2">
                            Entrar
                        </button>

                    </form>

                </div>

                <div class="card-footer text-center bg-white">
                    <small>
                        ¿No tienes cuenta?
                        <a href="{{ route('register') }}">Crear cuenta</a>
                    </small>
                </div>

            </div>

        </div>
    </div>

</div>

</body>
</html>