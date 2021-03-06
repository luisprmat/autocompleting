<?php

namespace App\Http\Controllers;

use App\Country;
use App\Sortable;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CountryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index']);
        $this->authorizeResource(Country::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Sortable $sortable)
    {
        $view = 'index';

        $sortable->setCurrentOrder(request('sort'));

        $countries = Country::query()
            ->when(in_array($sortable->getColumn(), ['id', 'name']) , function ($q) use ($sortable) {
                $q->orderBy($sortable->getColumn(), $sortable->getDirection());
            })
            ->paginate(10)
        ;


        return view('countries.index', compact(['countries', 'sortable', 'view']));
    }

    /**
     * Display a listing of the deleted resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function viewTrashed(Sortable $sortable)
    {
        $view = 'trash';

        $sortable->setCurrentOrder(request('sort'));

        $countries = Country::query()
            ->onlyTrashed()
            ->when(in_array($sortable->getColumn(), ['id', 'name']) , function ($q) use ($sortable) {
                $q->orderBy($sortable->getColumn(), $sortable->getDirection());
            })
            ->paginate(10)
        ;


        return view('countries.index', compact(['countries', 'sortable', 'view']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $country = new Country;

        return view('countries.create', compact('country'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|unique:countries'
        ], [
            'name.unique' => 'Este pais ya existe'
        ]);

        Country::create($request->all());

        return redirect()->route('countries.index')->withStatus('Se ha creado un pais exitosamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function show(Country $country)
    {
        return view('countries.show', compact('country'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function edit(Country $country)
    {
        return view('countries.edit', compact('country'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Country $country)
    {
        $request->validate([
            'name' => [
                'required',
                'min:3',
                Rule::unique('countries')->ignore($country)
            ]
        ], [
            'name.unique' => 'Este pais ya existe'
        ]);

        $country->update($request->all());

        return redirect()->route('countries.index')->withStatus('Pais actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function destroy(Country $country)
    {
        $country->delete();

        return redirect()->route('countries.index')->withStatus('Pais eliminado exitosamente');
    }

    /**
     * Restore the specified resource from trashed.
     *
     * @param  \App\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $country = Country::withTrashed()->where('id', $id)->firstOrFail();

        $country->restore();

        return redirect()->route('countries.index')->withStatus('Pais restaurado exitosamente');
    }

    /**
     * Delete the specified resource from trashed permanently.
     *
     * @param  \App\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function forceDelete($id)
    {
        $country = Country::withTrashed()->where('id', $id)->firstOrFail();

        $country->forceDelete();

        return redirect()->route('countries.index')->withStatus('Pais eliminado permanentemente');
    }
}
