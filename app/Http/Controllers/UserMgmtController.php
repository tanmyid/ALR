<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Menus;
use App\Models\Roles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


class UserMgmtController extends Controller
{
    public function index()
    {

        return view('user-management.index');
    }
    public function menu()
    {
        $routes = Route::getRoutes();

        $routesCollection = collect($routes);

        $routesInfo = $routesCollection->filter(function ($route) {
            return in_array('GET', $route->methods()) && in_array('web', $route->middleware());
        })->map(function ($route) {
            return [
                'uri' => $route->uri(),
            ];
        })->unique()->sortBy('uri')->values();

        $no = 1;

        $parent = Menus::all();

        return view('user-management.menu', compact('routesInfo', 'no', 'parent'));
    }
    public function role()
    {
        $roles = Roles::all();
        $no = 1;
        return view('user-management.role', compact('roles', 'no'));
    }
    public function tambahRole(Request $request)
    {
        $request->validate([
            'role' => 'required|string|max:255',
            'deskripsi' => 'required|string'
        ]);
        Roles::create([
            'role' => $request->input('role'),
            'desc' => $request->input('deskripsi')
        ]);
        return redirect()->route('usermgmt.role')->with('success', 'Data berhasil disimpan!');
    }
    public function editRole(Request $request, $id)
    {
        $request->validate([
            'role' => 'required|string|max:255',
            'deskripsi' => 'required|string'
        ]);
        $roles = Roles::findOrFail($id);
        $roles->update([
            'role' => $request->input('role'),
            'desc' => $request->input('deskripsi')
        ]);
        return redirect()->route('usermgmt.role')->with('success', 'Data berhasil diedit!');
    }
    public function delRole($id)
    {
        $roles = Roles::findOrFail($id);
        $roles->delete();
        return redirect()->route('usermgmt.role')->with('success', 'Data berhasil dihapus!');
    }

    public function tambahMenu(Request $request)
    {
        $request->validate([
            'menu' => 'required|string|max:255',
            'switchValue' => 'required|string',
            'subMenuValue' => 'required|boolean',
            'parent_id' => 'int',
            'url' => 'required|string',
            'icon' => 'required|string'
        ]);
        // $type = gettype($request);
        // dd($request);
        Menus::create([
            'menu' => $request->input('menu'),
            'parent_id' => $request->input('parent_id'),
            // 'deskripsi' => $request->input('deskripsi'),
            'type' => $request->input('switchValue'),
            'sub' => $request->input('subMenuValue'),
            'route' => $request->input('url'),
            'icon' => $request->input('icon')
        ]);
        return redirect()->route('usermgmt.menu')->with('success', 'Data berhasil disimpan!');
    }

    public function user()
    {
        $data_user = User::all();
        $no = 1;
        return view('user-management.user', compact('data_user', 'no'));
    }
    public function tambahUser(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'nama' => 'required|string',
            'email' => 'required|string',
            'password' => 'required|string',
            'subMenuValue' => 'required|boolean',
        ]);

        User::create([
            'name' => $request->input('nama'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'active' => $request->input('subMenuValue'),
        ]);
        return redirect()->route('usermgmt.user')->with('success', 'Data berhasil disimpan!');
    }
}
