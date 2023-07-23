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
     * Display a listing of the resource.
     */
    public function index()
    {
        $itineraries = DB::table('vw_itineraries')->get();
        return view('itineraries.index', compact('itineraries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $zones = Zone::all();
        $guides = Guide::all();

        return view('itineraries.form', compact('zones', 'guides'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'guide_id' => 'required|int',
            'zone_id' => 'required|int',
            'duration' => 'required|max:50',
            'max_visitors' => 'required|int',
            'start_time' => 'required',
        ]);

        Itinerary::create($request->all());

        return redirect()->route('itineraries.index')->with([ 'message' => 'Guia registrada satisfactoriamente', 'type' => 'success' ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        return Itinerary::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $itinerary = Itinerary::find($id);

        $zones = Zone::all();
        $guides = Guide::all();
        return view('itineraries.form', compact('itinerary', 'zones', 'guides'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $request->validate([
            'guide_id' => 'required|int',
            'zone_id' => 'required|int',
            'duration' => 'required|max:50',
            'max_visitors' => 'required|int',
            'start_time' => 'required',
        ]);

        $itinerary = Itinerary::find($id);

        $itinerary->fill($request->all());
        if ($itinerary->isClean())
            return redirect()->back()->with([ 'message' => 'Por lo menos un valor debe cambiar', 'type' => 'danger' ]);

        $itinerary->save();

        return redirect()->route('itineraries.index')->with([ 'message' => 'Zona actualizada satisfactoriamente', 'type' => 'success' ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $itinerary = Itinerary::find($id);
        $itinerary->delete();

        return view('itineraries.index', compact('itinerary'))->with([ 'message' => 'Zona eliminada satisfactoriamente', 'type' => 'success' ]);
    }
}
