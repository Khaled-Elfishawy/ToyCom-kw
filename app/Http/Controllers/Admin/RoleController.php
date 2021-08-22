<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Permission;
use App\Model\Role;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function __construct()
    {
    }
    function index()
    {
        $roles = Role::orderBy('created_at')->paginate(10);
        return view('admin-views.role.index', compact('roles'));
    }

    function list()
    {
        $roles=Role::latest()->paginate();
        return view('admin-views.role.list',compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $role = new Role();
        $role->name = $request->name;
        $role->save();

        Toastr::success('Role added successfully!');
        return redirect('admin/role/list');
    }

    public function edit($id)
    {
        $role = Role::find($id);
        return view('admin-views.role.edit', compact('role'));
    }


    public function update(Request $request, $id)
    {
        $role = Role::find($id);

        $request->validate([
            'name' => 'required',

        ]);
        $role->name = $request->name;
        $role->save();
        Toastr::success('Role updated successfully!');
        return redirect('admin/role/list');
    }

    public function delete(Request $request)
    {
        $role = Role::find($request->id);

        $role->delete();
        Toastr::success('Role removed!');
        return back();
    }
}

