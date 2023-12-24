<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\PropertyFormRequest;
//
use App\Models\immo\Property;
use App\Models\immo\Option;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.properties.index', [
            'properties' => Property::orderBy('created_at', 'desc')->paginate(5),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $property = new Property();
        $property->fill([
            'surface' => 40,
            'rooms' => 3,
            'bedrooms' => 1,
            'floor' => 0,
            'city' => 'Paris',
            'postal_code' => 75000,
            'sold' => false,
        ]);
        return view('admin.properties.form', [
            'property' => $property,
            'options' => Option::pluck('name', 'id'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PropertyFormRequest $request)
    {
        $property->options()->sync($request->validated('opttions'));
        $property = Property::create($request->validated());
        return redirect()
            ->route('admin.property.index')
            ->with('success', 'Le bien a bien été créé.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Property $property)
    {
        dd($property);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Property $property)
    {
        return view('admin.properties.form', [
            'property' => $property,
            'options' => Option::pluck('name', 'id'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PropertyFormRequest $request, Property $property)
    {
        // dd($request, $property);
        $property->options()->sync($request->validated('opttions'));
        $property->update($request->validated());
        return redirect()
            ->route('admin.property.index')
            ->with('success', 'le bien a bien été modifié');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Property $property)
    {
        $property->delete();
        return redirect()
            ->route('admin.property.index')
            ->with('success', 'le bien a bien été suprimé');
    }
}
