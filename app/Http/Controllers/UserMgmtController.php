<?php

namespace App\Http\Controllers;

use App\Models\Menus;
use App\Models\Roles;
use Illuminate\Http\Request;

class UserMgmtController extends Controller
{
    public function index()
    {

        return view('user-management.index');
    }
    public function menu()
    {
        return view('user-management.menu');
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
        // $request->validate([
        //     'menu' => 'required|string|max:255',
        //     'deskripsi' => 'required|string',
        //     'switchValue' => 'required|string',
        //     'subMenuValue' => 'required|string',
        //     'url' => 'required|string',
        //     'icon' => 'required|string'
        // ]);
        $type = gettype($request);
        dd($request->toArray());
        // Menus::create([
        //     'menu' => $request->input('menu'),
        //     'deskripsi' => $request->input('deskripsi'),
        //     'switchValue' => $request->input('switchValue'),
        //     'subMenuValue' => $request->input('subMenuValue'),
        //     'url' => $request->input('url'),
        //     'icon' => $request->input('icon')
        // ]);
        // return redirect()->route('usermgmt.menu')->with('success', 'Data berhasil disimpan!');
    }
}
