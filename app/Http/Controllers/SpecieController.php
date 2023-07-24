<?php

namespace App\Http\Controllers;

use App\Models\Caregiver;
use App\Models\Habitat;
use App\Models\Specie;
use App\Models\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SpecieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $species = DB::table('vw_species')->get();
        return view('species.index', compact('species'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $zones = Zone::all();
        $caregivers = Caregiver::all();
        $habitats = Habitat::all();

        return view('species.form', compact('zones', 'caregivers', 'habitats'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'caregiver_id' => 'required|int',
            'zone_id' => 'required|int',
            'habitat_id' => 'required|int',
            'name' => 'required|max:50|alpha',
            'scientific_name' => 'required|max:50|alpha',
            'gender' => 'required|max:50|alpha'
        ]);

        Specie::create($request->all());

        return redirect()->route('species.index')->with([ 'message' => 'Guia registrada satisfactoriamente', 'type' => 'success' ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        return Specie::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $specie = Specie::find($id);

        $zones = Zone::all();
        $caregivers = Caregiver::all();
        $habitats = Habitat::all();

        return view('species.form', compact('specie', 'zones', 'caregivers', 'habitats'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $request->validate([
            'caregiver_id' => 'required|int',
            'zone_id' => 'required|int',
            'habitat_id' => 'required|int',
            'name' => 'required|max:50|alpha',
            'scientific_name' => 'required|max:50',
            'gender' => 'required|max:50',
            'prueba' => 'required|max:45'
        ]);

        $itinerary = Specie::find($id);

        $itinerary->fill($request->all());
        if ($itinerary->isClean())
            return redirect()->back()->with([ 'message' => 'Por lo menos un valor debe cambiar', 'type' => 'danger' ]);

        $itinerary->save();

        return redirect()->route('species.index')->with([ 'message' => 'Especie actualizada satisfactoriamente', 'type' => 'success' ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $specie = Specie::find($id);
        $specie->delete();

        return redirect()->back()->with([ 'message' => 'Especie eliminada satisfactoriamente', 'type' => 'success' ]);
    }
}
