@extends('layouts.app')

@section('contenido')

<div class="container py-4">

    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-8">

            <div class="card shadow-sm">

                <div class="card-header bg-success text-white">
                    <h4 class="mb-0">
                        Nueva Tarea
                    </h4>
                </div>

                <div class="card-body">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Se encontraron los siguientes errores:</strong>
                            <ul class="mb-0 mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('tareas.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="titulo" class="form-label">Título</label>

                            <input
                                type="text"
                                id="titulo"
                                name="titulo"
                                value="{{ old('titulo') }}"
                                class="form-control @error('titulo') is-invalid @enderror">

                            @error('titulo')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>

                            <textarea
                                id="descripcion"
                                name="descripcion"
                                rows="4"
                                class="form-control @error('descripcion') is-invalid @enderror">{{ old('descripcion') }}</textarea>

                            @error('descripcion')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label for="estado" class="form-label">Estado</label>

                                <select
                                    id="estado"
                                    name="estado"
                                    class="form-select">

                                    <option value="pendiente" @selected(old('estado')=='pendiente')>
                                        Pendiente
                                    </option>

                                    <option value="en_progreso" @selected(old('estado')=='en_progreso')>
                                        En progreso
                                    </option>

                                    <option value="completada" @selected(old('estado')=='completada')>
                                        Completada
                                    </option>

                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="prioridad" class="form-label">Prioridad</label>

                                <select
                                    id="prioridad"
                                    name="prioridad"
                                    class="form-select">

                                    <option value="baja" @selected(old('prioridad')=='baja')>
                                        Baja
                                    </option>

                                    <option value="media" @selected(old('prioridad','media')=='media')>
                                        Media
                                    </option>

                                    <option value="alta" @selected(old('prioridad')=='alta')>
                                        Alta
                                    </option>

                                </select>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label for="fecha" class="form-label">Fecha</label>

                                <input
                                    type="date"
                                    id="fecha"
                                    name="fecha"
                                    value="{{ old('fecha') }}"
                                    class="form-control @error('fecha') is-invalid @enderror">

                                @error('fecha')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="asignado_a" class="form-label">Asignar a</label>

                                <select
                                    id="asignado_a"
                                    name="asignado_a"
                                    class="form-select @error('asignado_a') is-invalid @enderror">

                                    <option value="">-- Sin asignar --</option>

                                    @foreach($usuarios as $usuario)
                                        <option
                                            value="{{ $usuario->id }}"
                                            @selected(old('asignado_a') == $usuario->id)>
                                            {{ $usuario->name }}
                                        </option>
                                    @endforeach

                                </select>

                                @error('asignado_a')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                        </div>

                        <div class="d-flex flex-column flex-sm-row justify-content-between gap-2 mt-4">

                            <a href="{{ route('tareas.index') }}" class="btn btn-secondary">
                                Cancelar
                            </a>

                            <button type="submit" class="btn btn-success">
                                Guardar tarea
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>
    </div>

</div>

@endsection