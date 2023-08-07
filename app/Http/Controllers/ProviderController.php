<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;

use sisVentas\Models\Person;
use sisVentas\Http\Requests\PersonFormRequest;
use Illuminate\Support\Facades\Redirect;


class ProviderController extends Controller
{
    public function index(Request $request)
    {
        if ($request) {
            $search = $request->get('searchText');
            $providers = Person::findPersonByName($search, 'provider');
            return view('store.purchase.providers.index', compact('providers', 'search'));
        }
    }

    public function create()
    {
        return view('store.purchase.providers.create');
    }

    public function show($id)
    {
        $person = Person::findOrFail($id);
        return route('store.provider.show');
    }

    public function store(PersonFormRequest $request)
    {
        $person = new Person();
        $person->type_person = 'provider';
        $person->email = $request->get('email');
        $person->name = $request->get('name');
        $person->num_document = $request->get('num_document');
        $person->type_document = $request->get('type_document');
        $person->address = $request->get('address');
        $person->tel = $request->get('tel');
        $person->save();
        return Redirect::to('ventas/proveedor');
    }

    public function edit($id)
    {
        return view('store.purchase.providers.edit', ['provider' => Person::findOrFail($id)]);
    }

    public function update(PersonFormRequest $request, $id)
    {
        $person = Person::findOrFail($id);

        $person->email = $request->get('email');
        $person->name = $request->get('name');
        $person->num_document = $request->get('num_document');
        $person->type_document = $request->get('type_document');
        $person->address = $request->get('address');
        $person->tel = $request->get('tel');

        $person->update();
        return Redirect::to('ventas/proveedor');
    }

    public function destroy($id)
    {
        $person = Person::findOrFail($id);
        $person->type_person = 'inactive';
        $person->update();
        return Redirect::to('ventas/proveedor');
    }
}
