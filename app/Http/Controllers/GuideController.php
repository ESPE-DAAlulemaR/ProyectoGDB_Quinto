<?php

namespace App\Http\Controllers;

use App\Models\Guide;
use Illuminate\Http\Request;

class GuideController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $guides = Guide::all();
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
        $request->validate([
            'name' => 'required|max:30',
            'address' => 'required|max:50',
            'phone' => 'required|max:10',
            'email' => 'required|max:50|email',
            'start_date' => 'required|date',
        ]);

        Guide::create($request->all());

        return redirect()->route('guides.index')->with([ 'message' => 'Guia registrada satisfactoriamente', 'type' => 'success' ]);
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
        $request->validate([
            'name' => 'required|max:30',
            'address' => 'required|max:50',
            'phone' => 'required|max:10',
            'email' => 'required|max:50|email',
            'start_date' => 'required|date',
        ]);

        $guide = Guide::find($id);

        $guide->fill($request->all());
        if ($guide->isClean())
            return redirect()->back()->with([ 'message' => 'Por lo menos un valor debe cambiar', 'type' => 'danger' ]);

        $guide->save();

        return redirect()->route('guides.index')->with([ 'message' => 'Zona actualizada satisfactoriamente', 'type' => 'success' ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $guide = Guide::find($id);
        $guide->delete();

        return view('guides.index', compact('guide'))->with([ 'message' => 'Zona eliminada satisfactoriamente', 'type' => 'success' ]);
    }
}
