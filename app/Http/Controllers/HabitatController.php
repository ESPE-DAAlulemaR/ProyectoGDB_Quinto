<?php

namespace App\Http\Controllers;

use App\Models\Habitat;
use Illuminate\Http\Request;

class HabitatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $habitats = Habitat::all();
        return view('habitats.index', compact('habitats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('habitats.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:30|alpha',
            'climate' => 'required|max:30',
            'vegetation' => 'required|max:30',
            'contient' => 'required|max:30',
        ]);

        Habitat::create($request->all());

        return redirect()->route('habitats.index')->with([ 'message' => 'Habitat registrada satisfactoriamente', 'type' => 'success' ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        return Habitat::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $habitat = Habitat::find($id);
        return view('habitats.form', compact('habitat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $request->validate([
            'name' => 'required|max:30|alpha',
            'climate' => 'required|max:30',
            'vegetation' => 'required|max:30',
            'contient' => 'required|max:30',
        ]);

        $habitat = Habitat::findOrFail($id);

        $habitat->fill($request->all());
        if ($habitat->isClean())
            return redirect()->back()->with([ 'message' => 'Por lo menos un valor debe cambiar', 'type' => 'danger' ]);

        $habitat->save();

        return redirect()->route('habitats.index')->with([ 'message' => 'Habitat actualizada satisfactoriamente', 'type' => 'success' ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $habitat = Habitat::findOrFail($id);
        $habitat->delete();

        return redirect()->route('habitats.index')->with([ 'message' => 'Habitat eliminada satisfactoriamente', 'type' => 'success' ]);
    }
}
