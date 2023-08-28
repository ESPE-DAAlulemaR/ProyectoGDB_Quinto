<?php

namespace App\Http\Controllers;

use App\Models\Guide;
use Illuminate\Http\Request;

class GuideController extends Controller
{
    /**
     * Create a new entity service instance.
     *
     * @param  \App\Http\Services\Service $service
     * @return void
     */
    public function __construct(\App\Http\Services\Rest\Entities\Guide $service) {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $guides = Guide::with('zoo')->where('zoo_id', session('zooArr')['id'])->get();
        return view('guides.index', compact('guides'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('guides.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:30|regex:/^[a-zA-Z-\' ]+$/',
            'address' => 'required|max:50',
            'phone' => 'required|max:10|regex:/^09\d{8}$/',
            'email' => 'required|max:50|email',
            'start_date' => 'required|date',
        ]);

        $validated['zoo_id'] = session('zooArr')['id'];

        $this->service->createItem($validated);

        return redirect()->route('guides.index')->with([ 'message' => 'Guía registrada satisfactoriamente', 'type' => 'success' ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        return Guide::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $guide = Guide::find($id);
        return view('guides.form', compact('guide'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $validated = $request->validate([
            'name' => 'required|max:30|regex:/^[a-zA-Z-\' ]+$/',
            'address' => 'required|max:50',
            'phone' => 'required|max:10|regex:/^09\d{8}$/',
            'email' => 'required|max:50|email',
            'start_date' => 'required|date',
        ]);

        $validated['zoo_id'] = session('zooArr')['id'];

        $guide = Guide::find($id);

        $guide->fill($validated);
        if ($guide->isClean())
            return redirect()->back()->with([ 'message' => 'Por lo menos un valor debe cambiar', 'type' => 'danger' ]);

        $this->service->editItem($validated, $id);

        return redirect()->route('guides.index')->with([ 'message' => 'Guía actualizada satisfactoriamente', 'type' => 'success' ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $this->service->deleteItem([], $id);

        return redirect()->route('guides.index')->with(['message' => 'Guía eliminado satisfactoriamente', 'type' => 'success']);
    }
}
