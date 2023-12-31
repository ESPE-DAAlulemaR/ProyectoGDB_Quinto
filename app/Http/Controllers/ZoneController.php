<?php

namespace App\Http\Controllers;

use App\Models\Zone;
use Illuminate\Http\Request;

class ZoneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $zones = Zone::with('zoo')->where('zoo_id', session('zooArr')['id'])->get();
        return view('zones.index', compact('zones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('zones.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:30',
            'extension' => 'required|max:30',
        ]);

        $validated['zoo_id'] = session('zooArr')['id'];

        Zone::create($validated);

        return redirect()->route('zones.index')->with([ 'message' => 'Zona registrada satisfactoriamente', 'type' => 'success' ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        return Zone::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $zone = Zone::find($id);
        return view('zones.form', compact('zone'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $validated = $request->validate([
            'name' => 'required|max:30',
            'extension' => 'required|max:30',
        ]);

        $validated['zoo_id'] = session('zooArr')['id'];
        $zone = Zone::findOrFail($id);

        $zone->fill($validated);
        if ($zone->isClean())
            return redirect()->back()->with([ 'message' => 'Por lo menos un valor debe cambiar', 'type' => 'danger' ]);

        $zone->save();

        return redirect()->route('zones.index')->with([ 'message' => 'Zona actualizada satisfactoriamente', 'type' => 'success' ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $zone = Zone::findOrFail($id);
        $zone->delete();

        return redirect()->route('zones.index')->with([ 'message' => 'Zona eliminada satisfactoriamente', 'type' => 'success' ]);
    }
}
