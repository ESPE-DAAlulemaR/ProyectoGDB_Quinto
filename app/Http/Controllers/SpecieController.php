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
        $species = DB::select('SELECT * FROM vw_species WHERE zoo_id = ?', [session('zooArr')['id']]);

        return view('species.index', compact('species'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $zones = Zone::where('zoo_id', session('zooArr')['id'])->get();
        $caregivers = Caregiver::where('zoo_id', session('zooArr')['id'])->get();
        $habitats = Habitat::where('zoo_id', session('zooArr')['id'])->get();

        return view('species.form', compact('zones', 'caregivers', 'habitats'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'caregiver_id' => 'required|int',
            'zone_id' => 'required|int',
            'habitat_id' => 'required|int',
            'name' => 'required|max:50|alpha',
            'scientific_name' => 'required|max:50|alpha',
            'gender' => 'required|max:50|alpha'
        ]);

        $validated['zoo_id'] = session('zooArr')['id'];

        DB::select('SELECT * FROM insert_species_and_info(?, ?, ?, ?, ?, ?, ?)', [
            $validated['zone_id'],
            $validated['zoo_id'],
            $validated['name'],
            $validated['scientific_name'],
            $validated['gender'],
            $validated['caregiver_id'],
            $validated['habitat_id'],
        ]);

        return redirect()->route('species.index')->with(['message' => 'Especie registrada satisfactoriamente', 'type' => 'success']);
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

        $zones = Zone::where('zoo_id', session('zooArr')['id'])->get();
        $caregivers = Caregiver::where('zoo_id', session('zooArr')['id'])->get();
        $habitats = Habitat::where('zoo_id', session('zooArr')['id'])->get();

        return view('species.form', compact('specie', 'zones', 'caregivers', 'habitats'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $validated = $request->validate([
            'caregiver_id' => 'required|int',
            'zone_id' => 'required|int',
            'habitat_id' => 'required|int',
            'name' => 'required|max:50|alpha',
            'scientific_name' => 'required|max:50',
            'gender' => 'required|max:50'
        ]);

        $validated['zoo_id'] = session('zooArr')['id'];

        DB::select('SELECT * FROM update_species_and_info(?, ?, ?, ?, ?, ?, ?, ?)', [
            $id,
            $validated['zone_id'],
            $validated['zoo_id'],
            $validated['name'],
            $validated['scientific_name'],
            $validated['gender'],
            $validated['caregiver_id'],
            $validated['habitat_id'],
        ]);

        return redirect()->route('species.index')->with(['message' => 'Especie actualizada satisfactoriamente', 'type' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        DB::select('SELECT * FROM delete_species_and_info(?)', [$id]);

        return redirect()->back()->with(['message' => 'Especie eliminada satisfactoriamente', 'type' => 'success']);
    }

    function storeWithCaregiver(Request $request)
    {
        session([
            'whithCaregiver' => true
        ]);

        $validated = $request->validate([
            // Especie
            'zone_id' => 'required|int',
            'habitat_id' => 'required|int',
            'name' => 'required|max:50|alpha',
            'scientific_name' => 'required|max:50|alpha',
            'gender' => 'required|max:50|alpha',

            // Cuidador
            'caregiver_name' => 'required|max:30|alpha',
            'address' => 'required|max:50',
            'phone' => 'required|max:10',
            'start_date' => 'required|date',
        ]);

        $validated['zoo_id'] = session('zooArr')['id'];

        $result1 = DB::select('SELECT * FROM insert_caregiver_and_species(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [
            // Pametros para especie
            $validated['habitat_id'],
            $validated['zone_id'],
            $validated['zoo_id'],
            $validated['name'],
            $validated['scientific_name'],
            $validated['gender'],

            // Parametros para Cuidador
            $validated['caregiver_name'],
            $validated['address'],
            $validated['phone'],
            $validated['start_date'],
        ])[0];

        // Llamar a la función insert_species_additional_info para insertar información adicional de la especie
        DB::select('SELECT insert_species_additional_info(?, ?, ?)', [
            $result1->species_id, // species_id
            $result1->caregiver_id, // caregiver_id
            $validated['habitat_id'],
        ]);

        return redirect()->route('species.index')->with(['message' => 'Especie y cuidador registrados satisfactoriamente', 'type' => 'success']);
    }
}
