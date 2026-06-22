@extends('layouts.app')

@section('contenido')

<div class="container py-4">

    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-8">

            <div class="card shadow-sm">
                <div class="card-header bg-warning text-dark">
                    <h4 class="mb-0">
                        <i class="bi bi-pencil-square"></i> Editar Tarea
                    </h4>
                </div>

                <div class="card-body">

                    <form action="{{ route('tareas.update', $tarea) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="titulo" class="form-label">Título</label>
                            <input
                                type="text"
                                name="titulo"
                                id="titulo"
                                value="{{ old('titulo', $tarea->titulo) }}"
                                class="form-control @error('titulo') is-invalid @enderror">

                            @error('titulo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción y comentarios</label>

                            <textarea
                                name="descripcion"
                                id="descripcion"
                                rows="4"
                                class="form-control @error('descripcion') is-invalid @enderror">{{ old('descripcion', $tarea->descripcion) }}</textarea>

                            @error('descripcion')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label for="estado" class="form-label">Estado</label>

                                <select
                                    name="estado"
                                    id="estado"
                                    class="form-select">

                                    <option value="pendiente" @selected(old('estado',$tarea->estado)=='pendiente')>
                                        Pendiente
                                    </option>

                                    <option value="en_progreso" @selected(old('estado',$tarea->estado)=='en_progreso')>
                                        En progreso
                                    </option>

                                    <option value="completada" @selected(old('estado',$tarea->estado)=='completada')>
                                        Completada
                                    </option>

                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="prioridad" class="form-label">Prioridad</label>

                                <select
                                    name="prioridad"
                                    id="prioridad"
                                    class="form-select">

                                    <option value="baja" @selected(old('prioridad',$tarea->prioridad)=='baja')>
                                        Baja
                                    </option>

                                    <option value="media" @selected(old('prioridad',$tarea->prioridad)=='media')>
                                        Media
                                    </option>

                                    <option value="alta" @selected(old('prioridad',$tarea->prioridad)=='alta')>
                                        Alta
                                    </option>

                                </select>
                            </div>

                        </div>

                        <div class="mb-4">
                            <label for="asignado_a" class="form-label">
                                Asignar a
                            </label>

                            <select
                                name="asignado_a"
                                id="asignado_a"
                                class="form-select @error('asignado_a') is-invalid @enderror">

                                <option value="">-- Sin asignar --</option>

                                @foreach($usuarios as $usuario)
                                    <option
                                        value="{{ $usuario->id }}"
                                        @selected(old('asignado_a', $tarea->asignado_a) == $usuario->id)>
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

                        <div class="d-flex flex-column flex-sm-row justify-content-between gap-2">

                            <a href="{{ route('tareas.index') }}" class="btn btn-secondary">
                                Volver
                            </a>

                            <button type="submit" class="btn btn-primary">
                                Actualizar tarea
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>
    </div>

</div>

@endsection