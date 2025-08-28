<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Highlight;
use App\Models\User; // Asegúrate de que este modelo exista y esté correctamente definido

class HighlightController extends Controller
{
    // Mostrar todos los highlights
    public function index()
    {
        $highlights = Highlight::with('user')->orderBy('order')->get()->map(function($highlight) {
            return [
                'order'  => $highlight->order,
                'user_id'  => $highlight->user_id,
                'name' => $highlight->user->name ? $highlight->user->name : null,
                'avatar'   => $highlight->user ? url($highlight->user->avatar) : null,
                'username' => $highlight->user ? $highlight->user->username : null,
            ];
        });

        $users = User::where('role', 'normal')
            ->whereNotIn('id', function($query) {
                $query->select('user_id')->from('highlights');
            })
            ->get(['id', 'username']);

        return view('admin.highlights', compact('highlights' , 'users'));
    }

    // Mostrar formulario de creación
    public function create()
    {
        return view('highlights.create');
    }

    // Guardar un nuevo highlight
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            // otros campos...
        ]);

        Highlight::create($request->all());
        return redirect()->route('highlights.index')->with('success', 'Highlight creado correctamente.');
    }

    // Mostrar formulario de edición
    public function edit(Highlight $highlight)
    {
        return view('highlights.edit', compact('highlight'));
    }

    // Actualizar un highlight
    public function update(Request $request, Highlight $highlight)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            // otros campos...
        ]);

        $highlight->update($request->all());
        return redirect()->route('highlights.index')->with('success', 'Highlight actualizado correctamente.');
    }

    // Eliminar un highlight
    public function destroy(Highlight $highlight)
    {
        $highlight->delete();
        return redirect()->route('highlights.index')->with('success', 'Highlight eliminado correctamente.');
    }

    public function add(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'order'   => 'required|integer|min:1',
        ]);

        // Obtener los highlights a partir del nuevo order, ordenados
        $highlights = Highlight::where('order', '>=', $validated['order'])
            ->orderBy('order')
            ->get();

        $currentOrder = $validated['order'];
        foreach ($highlights as $highlight) {
            if ($highlight->order == $currentOrder) {
                $highlight->order += 1;
                $highlight->save();
                $currentOrder++;
            } else {
                // Hay un hueco, detenemos el proceso
                break;
            }
        }

        // Crear el nuevo highlight
        Highlight::create([
            'user_id' => $validated['user_id'],
            'order'   => $validated['order'],
        ]);

        return redirect()->back()->with('success', 'Usuario agregado al top creadores.');
    }

    public function remove($user_id)
    {
        $highlight = Highlight::where('user_id', $user_id)->first();
        if ($highlight) {
            $highlight->delete();
            return redirect()->back()->with('success', 'Highlight eliminado correctamente.');
        }
        return redirect()->back()->with('error', 'Highlight no encontrado.');
    }

}
