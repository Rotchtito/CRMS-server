<?php

namespace App\Http\Controllers;

use App\Models\Suspect;
use Illuminate\Http\Request;

class SuspectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suspects = Suspect::all();
        return response()->json($suspects);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // You may implement this method if you want to display a form for creating a new suspect.
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer',
            'description' => 'required|string',
            'address' => 'required|string|max:255',
        ]);

        $suspect = Suspect::create($request->all());
        return response()->json($suspect, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Suspect $suspect)
    {
        return response()->json($suspect);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Suspect $suspect)
    {
        // You may implement this method if you want to display a form for editing a specific suspect.
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Suspect $suspect)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer',
            'description' => 'required|string',
            'address' => 'required|string|max:255',
        ]);

        $suspect->update($request->all());
        return response()->json($suspect, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Suspect $suspect)
    {
        $suspect->delete();
        return response()->json(null, 204);
    }
}
