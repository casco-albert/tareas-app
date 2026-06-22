@extends('layouts.app')

@section('contenido')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Mis Tareas</h3>
    <a href="{{ route('tareas.create') }}" class="btn btn-primary">
        Nueva tarea
    </a>
</div>
<form method="GET" action="{{ route('tareas.index') }}" class="mb-3">
    <div class="row g-2">

        <div class="col-12 col-md-10">
            <input
                type="text"
                name="buscar"
                class="form-control"
                placeholder="Buscar por título o descripción..."
                value="{{ request('buscar') }}">
        </div>

        <div class="col-12 col-md-2 d-grid">
            <button class="btn btn-primary">
                Buscar
            </button>
        </div>

    </div>
</form>
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="table-responsive">
    <table class="table table-bordered table-hover align-middle">
        <thead class="table-dark">
            <tr>
                <th>Título</th>
                <th>Estado</th>
                <th>Prioridad</th>
                <th>Fecha</th>
                <th>Creado por</th>
                <th>Asignado a</th>
                <th class="text-center">Acciones</th>
            </tr>
        </thead>

        <tbody>
            @forelse($tareas as $tarea)
                <tr>
                    <td>{{ $tarea->titulo }}</td>
                    <td>{{ $tarea->estado }}</td>
                    <td>{{ $tarea->prioridad }}</td>
                    <td>{{ $tarea->fecha?->format('d/m/Y') }}</td>
                    <td>{{ optional($tarea->creadoPor)->name }}</td>
                    <td>{{ optional($tarea->asignadoA)->name ?? 'Sin asignar' }}</td>

                    <td class="text-nowrap text-center">
                        <a href="{{ route('tareas.show', $tarea) }}" class="btn btn-info btn-sm">
                            Ver
                        </a>

                        <a href="{{ route('tareas.edit', $tarea) }}" class="btn btn-warning btn-sm">
                            Editar
                        </a>

                        <form action="{{ route('tareas.destroy', $tarea) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('¿Eliminar tarea?')">
                                Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">
                        No hay tareas registradas.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="d-flex justify-content-center">
    {{ $tareas->links() }}
</div>

@endsection