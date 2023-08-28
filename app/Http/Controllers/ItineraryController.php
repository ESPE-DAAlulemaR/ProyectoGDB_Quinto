<?php

namespace App\Http\Controllers;

use App\Models\Guide;
use App\Models\Itinerary;
use App\Models\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ItineraryController extends Controller
{
    /**
     * Create a new entity service instance.
     *
     * @param  \App\Http\Services\Service $service
     * @return void
     */
    public function __construct(\App\Http\Services\Rest\Entities\Itinerary $service) {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $itineraries = Itinerary::getItineraries(session('zooArr')['numeric_code']);
        return view('itineraries.index', compact('itineraries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $zones = Zone::where('zoo_id', session('zooArr')['id'])->get();
        $guides = Guide::where('zoo_id', session('zooArr')['id'])->get();

        return view('itineraries.form', compact('zones', 'guides'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'guide_id' => 'required|int',
            'zone_id' => 'required|int',
            'duration' => 'required|max:50',
            'max_visitors' => 'required|int',
            'start_time' => 'required',
        ]);

        $validated['zoo_id'] = session('zooArr')['id'];

        $this->service->createItem($validated);

        return redirect()->route('itineraries.index')->with([ 'message' => 'Itinerario registrado satisfactoriamente', 'type' => 'success' ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        return Itinerary::getItinerary(session('zooArr')['numeric_code'], $id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $itinerary = Itinerary::getItinerary(session('zooArr')['numeric_code'], $id);

        $zones = Zone::where('zoo_id', session('zooArr')['id'])->get();
        $guides = Guide::where('zoo_id', session('zooArr')['id'])->get();
        return view('itineraries.form', compact('itinerary', 'zones', 'guides'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $validated = $request->validate([
            'guide_id' => 'required|int',
            'zone_id' => 'required|int',
            'duration' => 'required|max:50',
            'max_visitors' => 'required|int',
            'start_time' => 'required',
        ]);

        $validated['zoo_id'] = session('zooArr')['id'];
        $validated['zoo_numeric_code'] = session('zooArr')['numeric_code'];

        $this->service->editItem($validated, $id);

        return redirect()->route('itineraries.index')->with([ 'message' => 'Itinerario actualizada satisfactoriamente', 'type' => 'success' ]);


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $this->service->deleteItem([
            'zoo_numeric_code' => session('zooArr')['numeric_code']
        ], $id);

        return redirect()->route('itineraries.index')->with([ 'message' => 'Itinerario eliminado satisfactoriamente', 'type' => 'success' ]);
    }
}
