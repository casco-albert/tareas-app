<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container py-5">

    <div class="row justify-content-center">
        <div class="col-12 col-sm-10 col-md-7 col-lg-5">

            <div class="card shadow-sm border-0">

                <div class="card-header bg-success text-white text-center">
                    <h4 class="mb-0">Crear cuenta</h4>
                </div>

                <div class="card-body p-4">

                    {{-- ERRORES --}}
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <strong>Revisa los datos:</strong>
                            <ul class="mb-0 mt-2">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- FORMULARIO --}}
                    <form method="POST" action="{{ url('/register') }}">
                        @csrf

                        {{-- NOMBRE --}}
                        <div class="mb-3">
                            <label class="form-label">Nombre</label>
                            <input type="text"
                                   name="name"
                                   class="form-control"
                                   value="{{ old('name') }}"
                                   placeholder="Ej: Juan Pérez"
                                   required>
                        </div>

                        {{-- EMAIL --}}
                        <div class="mb-3">
                            <label class="form-label">Correo electrónico</label>
                            <input type="email"
                                   name="email"
                                   class="form-control"
                                   value="{{ old('email') }}"
                                   placeholder="ejemplo@email.com"
                                   required>
                        </div>

                        {{-- CONTRASEÑA --}}
                        <div class="mb-3">
                            <label class="form-label">Contraseña</label>
                            <input type="password"
                                   name="password"
                                   class="form-control"
                                   placeholder="Mínimo 8 caracteres"
                                   required>
                        </div>

                        {{-- CONFIRMAR --}}
                        <div class="mb-3">
                            <label class="form-label">Confirmar contraseña</label>
                            <input type="password"
                                   name="password_confirmation"
                                   class="form-control"
                                   placeholder="Repite la contraseña"
                                   required>
                        </div>

                        {{-- BOTÓN --}}
                        <button class="btn btn-success w-100 py-2">
                            Registrarse
                        </button>

                    </form>

                </div>

                <div class="card-footer text-center bg-white">
                    <small>
                        ¿Ya tienes cuenta?
                        <a href="{{ route('login') }}">Inicia sesión</a>
                    </small>
                </div>

            </div>

        </div>
    </div>

</div>

</body>
</html>