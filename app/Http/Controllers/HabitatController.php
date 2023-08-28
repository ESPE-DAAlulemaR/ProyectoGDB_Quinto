<?php

namespace App\Http\Controllers;

use App\Models\Habitat;
use Illuminate\Http\Request;

class HabitatController extends Controller
{
    /**
     * Create a new entity service instance.
     *
     * @param  \App\Http\Services\Service $service
     * @return void
     */
    public function __construct(\App\Http\Services\Rest\Entities\Habitat $service) {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $habitats = Habitat::with('zoo')->where('zoo_id', session('zooArr')['id'])->get();
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
        $validated = $request->validate([
            'name' => 'required|max:30|regex:/^[a-zA-Z-\' ]+$/',
            'climate' => 'required|max:30',
            'vegetation' => 'required|max:30',
            'continent' => 'required|max:30',
        ]);

        $validated['zoo_id'] = session('zooArr')['id'];

        $this->service->createItem($validated);

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
        $validated = $request->validate([
            'name' => 'required|max:30|regex:/^[a-zA-Z-\' ]+$/',
            'climate' => 'required|max:30',
            'vegetation' => 'required|max:30',
            'continent' => 'required|max:30',
        ]);

        $validated['zoo_id'] = session('zooArr')['id'];

        $habitat = Habitat::findOrFail($id);

        $habitat->fill($validated);
        if ($habitat->isClean())
            return redirect()->back()->with([ 'message' => 'Por lo menos un valor debe cambiar', 'type' => 'danger' ]);

        $this->service->editItem($validated, $id);

        return redirect()->route('habitats.index')->with([ 'message' => 'Habitat actualizada satisfactoriamente', 'type' => 'success' ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $this->service->deleteItem([], $id);

        return redirect()->route('habitats.index')->with([ 'message' => 'Habitat eliminada satisfactoriamente', 'type' => 'success' ]);
    }
}
