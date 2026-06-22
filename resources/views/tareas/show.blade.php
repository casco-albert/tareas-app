@extends('layouts.app')

@section('contenido')

<div class="container py-4">

    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-8">

            <div class="card shadow-sm">

                <div class="card-header bg-info text-white">
                    <h4 class="mb-0">
                        Detalle de la Tarea
                    </h4>
                </div>

                <div class="card-body">

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Título</strong>
                            <p class="mb-0">{{ $tarea->titulo }}</p>
                        </div>

                        <div class="col-md-6">
                            <strong>Fecha</strong>
                            <p class="mb-0">
                                {{ $tarea->fecha ? $tarea->fecha->format('d/m/Y') : 'Sin fecha' }}
                            </p>
                        </div>
                    </div>

                    <div class="mb-3">
                        <strong>Descripción y comentarios</strong>
                        <div class="border rounded p-3 bg-light">
                            {{ $tarea->descripcion ?: 'Sin descripción' }}
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <strong>Estado</strong><br>

                            <span class="badge bg-{{ $tarea->color_estado }}">
                                {{ $tarea->etiqueta_estado }}
                            </span>
                        </div>

                        <div class="col-md-6 mb-3">
                            <strong>Prioridad</strong><br>

                            <span class="badge bg-{{ $tarea->color_prioridad }}">
                                {{ $tarea->etiqueta_prioridad }}
                            </span>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <strong>Creado por</strong>
                            <p class="mb-0">
                                {{ optional($tarea->creadoPor)->name }}
                            </p>
                        </div>

                        <div class="col-md-6 mb-3">
                            <strong>Asignado a</strong>
                            <p class="mb-0">
                                {{ optional($tarea->asignadoA)->name ?? 'Sin asignar' }}
                            </p>
                        </div>

                    </div>

                    <hr>

                    <div class="d-flex flex-column flex-sm-row justify-content-between gap-2">

                        <a href="{{ route('tareas.index') }}" class="btn btn-secondary">
                            Volver
                        </a>

                        <div>
                            <a href="{{ route('tareas.edit', $tarea) }}" class="btn btn-warning">
                                Editar
                            </a>

                            <form action="{{ route('tareas.destroy', $tarea) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="btn btn-danger"
                                    onclick="return confirm('¿Está seguro de eliminar esta tarea?')">
                                    Eliminar
                                </button>
                            </form>
                        </div>

                    </div>

                </div>

            </div>

        </div>
    </div>

</div>

@endsection