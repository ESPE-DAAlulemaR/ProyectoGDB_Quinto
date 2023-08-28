<?php

namespace App\Http\Controllers;

use App\Models\Caregiver;
use Illuminate\Http\Request;

class CaregiverController extends Controller
{
    /**
     * Create a new entity service instance.
     *
     * @param  \App\Http\Services\Service $service
     * @return void
     */
    public function __construct(\App\Http\Services\Rest\Entities\Caregiver $service) {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $caregivers = Caregiver::with('zoo')->where('zoo_id', session('zooArr')['id'])->get();
        return view('caregivers.index', compact('caregivers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('caregivers.form');
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
            'start_date' => 'required|date',
        ]);

        $validated['zoo_id'] = session('zooArr')['id'];
        $this->service->createItem($validated);

        return redirect()->route('caregivers.index')->with([ 'message' => 'Cuidador registrada satisfactoriamente', 'type' => 'success' ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        return Caregiver::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $caregiver = Caregiver::find($id);
        return view('caregivers.form', compact('caregiver'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $validated = $request->validate([
            'name' => 'required|max:30|regex:/^[a-zA-Z-\' ]+$/',
            'address' => 'required|max:50',
            'phone' => 'required|regex:/^09\d{8}$/',
            'start_date' => 'required|date',
        ]);

        $validated['zoo_id'] = session('zooArr')['id'];

        $caregiver = Caregiver::findOrFail($id);

        $caregiver->fill($request->all());
        if ($caregiver->isClean())
            return redirect()->back()->with([ 'message' => 'Por lo menos un valor debe cambiar', 'type' => 'danger' ]);

        $this->service->editItem($validated, $id);

        return redirect()->route('caregivers.index')->with([ 'message' => 'Cuidador actualizada satisfactoriamente', 'type' => 'success' ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $this->service->deleteItem([], $id);

        return redirect()->route('caregivers.index')->with([ 'message' => 'Cuidador eliminado satisfactoriamente', 'type' => 'success' ]);
    }
}
