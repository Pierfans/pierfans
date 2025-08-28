<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InitialPost;
use App\Models\Updates;

class InitialPostController extends Controller
{
    public function index()
    {
        $initialPosts = InitialPost::with('updateRelation')->orderBy('order')->get();
        $updates = \App\Models\Updates::with(['user', 'media'])->orderByDesc('id')->get();

        // Para cada update, asignar el primer media (si existe) a una propiedad para facilitar la vista
        foreach ($updates as $update) {
            $update->media = $update->media->first();
        }
        return view('admin.initial_posts.index', compact('initialPosts', 'updates'));
    }

    public function create()
    {
        $updates = Updates::all();
        return view('admin.initial_posts.create', compact('updates'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'update_id' => 'required|exists:updates,id',
            'order' => 'required|integer',
        ]);
        InitialPost::create($request->only(['update_id', 'order']));
        return redirect()->route('admin.initial-posts.index')->with('success', 'Initial Post añadido correctamente');
    }

    public function edit($id)
    {
        $initialPost = InitialPost::findOrFail($id);
        $updates = Updates::all();
        return view('admin.initial_posts.edit', compact('initialPost', 'updates'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'update_id' => 'required|exists:updates,id',
            'order' => 'required|integer',
        ]);
        $initialPost = InitialPost::findOrFail($id);
        $initialPost->update($request->only(['update_id', 'order']));
        return redirect()->route('admin.initial-posts.index')->with('success', 'Initial Post updated successfully');
    }

    public function preview($id)
    {
        $update = \App\Models\Updates::with(['user', 'media'])->findOrFail($id);
        $update->media = $update->media->first();
        return view('components.post-card', compact('update'))->render();
    }


    public function destroy($id)
    {
        $initialPost = InitialPost::findOrFail($id);
        $initialPost->delete();
        return redirect()->route('admin.initial-posts.index')->with('success', 'Initial Post eliminado correctamente');
    }
}
