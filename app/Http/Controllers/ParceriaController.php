<?php

namespace App\Http\Controllers;

use App\Models\Parceria;
use App\Models\ParceriaHistory;
use Illuminate\Http\Request;

class ParceriaController extends Controller
{
    public function index()
    {
        $userId = auth()->id();
        $parceriasEnviadas = Parceria::where('user_origin_id', $userId)->with('userDestiny')->get();
        $parceriasRecibidas = Parceria::where('user_destiny_id', $userId)->with('userOrigin')->get();
        $parcerias = $parceriasEnviadas->merge($parceriasRecibidas)->sortByDesc('created_at');

        return view('index.parceria', compact('parcerias'));
    }

    // Crear una parceria
    public function store(Request $request)
    {

        $parceria = Parceria::create([
            'user_origin_id' => auth()->user()->id,
            'user_destiny_id' => $request->creator_id,
            'active' => true,
        ]);


        $history = \App\Models\ParceriaHistory::create([
            'parceria_id' => $parceria->id,
            'text' => $request->input('mensaje', 'Parceria creada'), // Puedes ajustar el texto
            'sender_id' => auth()->user()->id,
        ]);

        return redirect()->route('home')->with('success', 'Parceria creado correctamente.');
    }

    // Agregar historial a una parceria
    public function addHistory(Request $request, $parceriaId)
    {
        $history = ParceriaHistory::create([
            'parceria_id' => $parceriaId,
            'text' => $request->text,
            'sender_id' => $request->sender_id,
        ]);
        return response()->json($history);
    }

    // Obtener parceria con historial
    public function show($id)
    {
        $parceria = Parceria::with(['userOrigin', 'userDestiny', 'histories.sender'])->findOrFail($id);
        return response()->json($parceria);
    }

    // app/Http/Controllers/ParceriaController.php
    public function mensajes($id)
    {
        $userId = auth()->id();
        $parceria = Parceria::where('id', $id)
            ->where(function($q) use ($userId) {
                $q->where('user_origin_id', $userId)
                    ->orWhere('user_destiny_id', $userId);
            })
            ->firstOrFail();

        $mensajes = ParceriaHistory::with('sender')
            ->where('parceria_id', $parceria->id)
            ->orderBy('created_at', 'asc')
            ->get();

        return view('includes.parcerias.messages', compact('parceria', 'mensajes'));
    }

    public function enviar(Request $request, $parceriaId)
    {
        $request->validate([
            'mensaje' => 'required|string|max:1000',
        ]);

        $userId = auth()->id();
        $parceria = Parceria::where('id', $parceriaId)
            ->where(function($q) use ($userId) {
                $q->where('user_origin_id', $userId)
                    ->orWhere('user_destiny_id', $userId);
            })
            ->firstOrFail();

        ParceriaHistory::create([
            'parceria_id' => $parceriaId,
            'text' => $request->input('mensaje', 'Parceria creada'),
            'sender_id' => $userId,
        ]);

        return redirect()->back()->with('success', 'Mensaje enviado correctamente.');
    }


}
