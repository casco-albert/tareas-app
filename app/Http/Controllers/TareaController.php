<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TareaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

  
    public function index(Request $request)
    {
        $this->authorize('viewAny', Tarea::class);

        $query = Tarea::with(['creadoPor', 'asignadoA'])
            ->where(function ($q) {
                $q->where('creado_por', Auth::id())
                  ->orWhere('asignado_a', Auth::id());
            });

        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        if ($request->filled('prioridad')) {
            $query->where('prioridad', $request->prioridad);
        }

        if ($request->filled('buscar')) {
            $buscar = $request->buscar;

            $query->where(function ($q) use ($buscar) {
                $q->where('titulo', 'like', "%$buscar%")
                ->orWhere('descripcion', 'like', "%$buscar%");
            });
        }

        $tareas = $query->latest()->paginate(10)->withQueryString();

        $stats = [
            'total' => Tarea::where(function ($q) {
                $q->where('creado_por', Auth::id())
                  ->orWhere('asignado_a', Auth::id());
            })->count(),

            'pendiente' => Tarea::where(function ($q) {
                $q->where('creado_por', Auth::id())
                  ->orWhere('asignado_a', Auth::id());
            })->where('estado', 'pendiente')->count(),

            'en_progreso' => Tarea::where(function ($q) {
                $q->where('creado_por', Auth::id())
                  ->orWhere('asignado_a', Auth::id());
            })->where('estado', 'en_progreso')->count(),

            'completada' => Tarea::where(function ($q) {
                $q->where('creado_por', Auth::id())
                  ->orWhere('asignado_a', Auth::id());
            })->where('estado', 'completada')->count(),
        ];

        return view('tareas.index', compact('tareas', 'stats'));
    }


    public function create()
    {
        $this->authorize('create', Tarea::class);

        $usuarios = User::orderBy('name')->get();

        return view('tareas.create', compact('usuarios'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', Tarea::class);

        $datos = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string|max:2000',
            'estado' => 'required|in:pendiente,en_progreso,completada',
            'prioridad' => 'required|in:baja,media,alta',
            'fecha' => 'nullable|date|after_or_equal:today',
            'asignado_a' => 'nullable|exists:users,id',
        ]);

        $datos['creado_por'] = Auth::id();

        Tarea::create($datos);

        return redirect()
            ->route('tareas.index')
            ->with('success', 'La tarea fue creada correctamente.');
    }


    public function show(Tarea $tarea)
    {
        $this->authorize('view', $tarea);

        $tarea->load(['creadoPor', 'asignadoA']);

        return view('tareas.show', compact('tarea'));
    }

    public function edit(Tarea $tarea)
    {
        $this->authorize('update', $tarea);

        $usuarios = User::orderBy('name')->get();

        return view('tareas.edit', compact('tarea', 'usuarios'));
    }

    public function update(Request $request, Tarea $tarea)
    {
        $this->authorize('update', $tarea);

        $datos = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string|max:2000',
            'estado' => 'required|in:pendiente,en_progreso,completada',
            'prioridad' => 'required|in:baja,media,alta',
            'fecha' => 'nullable|date',
            'asignado_a' => 'nullable|exists:users,id',
        ]);

        $tarea->update($datos);

        return redirect()
            ->route('tareas.show', $tarea)
            ->with('success', 'La tarea fue actualizada correctamente.');
    }

    public function destroy(Tarea $tarea)
    {
        $this->authorize('delete', $tarea);

        $tarea->delete();

        return redirect()
            ->route('tareas.index')
            ->with('success', 'La tarea fue eliminada.');
    }
}