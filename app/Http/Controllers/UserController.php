<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\UserFormRequest;
use sisVentas\Models\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if ($request) {
            $query = trim($request->get('searchText'));
            $users = DB::table('users')->where('name', 'LIKE', '%' . $query . '%')
                ->orderBy('id', 'desc')
                ->paginate(7);
            return view('security.user.index', ['users' => $users, 'searchText' => $query]);
        }
    }

    public function create()
    {
        return view('security.user.create');
    }

    public function store(UserFormRequest $request)
    {
        $user = new User();
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->password = bcrypt($request->get('password'));
        $user->save();
        return Redirect::to('seguridad/usuario');
    }

    public function edit($user)
    {
        return view('security.user.edit', ['user' => User::findOrFail($user)]);
    }

    public function update(Request $request, $user)
    {
        $user = User::findOrFail($user);
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->password = bcrypt($request->get('password'));
        $user->update();
        return Redirect::to('seguridad/usuario');
    }

    public function destory($user)
    {
        $user = DB::table('users')->where('id', '=', $user)->delete();
        return Redirect::to('seguridad/usuario');
    }
}
