<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;

use sisVentas\Models\Person;
use sisVentas\Http\Requests\PersonFormRequest;
use Illuminate\Support\Facades\Redirect;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        if ($request) {
            $search = $request->get('searchText');
            $clients = Person::findPersonByName($search, 'client');
            return view('store.clients.index', compact('clients', 'search'));
        }
    }

    public function create()
    {
        return view('store.clients.create');
    }

    public function show($id)
    {
        $person = Person::findOrFail($id);
        return route('store.client.show');
    }

    public function store(PersonFormRequest $request)
    {
        $person = new Person();
        $person->type_person = 'client';
        $person->email = $request->get('email');
        $person->name = $request->get('name');
        $person->num_document = $request->get('num_document');
        $person->type_document = $request->get('type_document');
        $person->address = $request->get('address');
        $person->tel = $request->get('tel');
        $person->save();
        return Redirect::to('ventas/cliente');
    }

    public function edit($id)
    {
        return view('store.clients.edit', ['client' => Person::findOrFail($id)]);
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
        return Redirect::to('ventas/cliente');
    }

    public function destroy($id)
    {
        $person = Person::findOrFail($id);
        $person->type_person = 'inactive';
        $person->update();
        return Redirect::to('ventas/cliente');
    }
}
