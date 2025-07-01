<?php

namespace App\Http\Controllers;


use App\Models\areas;
use App\Models\town;
use App\Models\warehouses;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $towns = town::all();
        
            $areas = areas::all();
     

        return view('area.index', compact('areas', 'towns'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|unique:areas,name'
            ]
        );

        areas::create(
            [
                'townID' => $request->townID,
                'name' => $request->name
            ]
        );
        return back()->with("success", "Area Created");
    }

    /**
     * Display the specified resource.
     */
    public function show(warehouses $warehouses)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(warehouses $warehouses)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $request->validate(
            [
                'name' => 'required|unique:areas,name,' . $id,
            ]
        );

        $area = areas::find($id);
        $area->update(
            [
                'townID' => $request->townID,
                'name' => $request->name,
            ]
        );
        return back()->with('success', "Area Updated");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(warehouses $warehouses)
    {
        //
    }
}
