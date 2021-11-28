<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Permission;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    function index()
    {
        $permissions = Permission::orderBy('created_at')->paginate(10);
        return view('admin-views.permission.index', compact('permissions'));
    }

    function list()
    {
        $permissions=Permission::latest()->paginate();
        return view('admin-views.permission.list',compact('permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $per = new Permission();
        $per->name = $request->name;
        $per->guard_name='admin';
        $per->save();

        Toastr::success('Permission added successfully!');
        return redirect('admin/permission/list');
    }

    public function edit($id)
    {
        $per = Permission::find($id);
        return view('admin-views.permission.edit', compact('per'));
    }


    public function update(Request $request, $id)
    {

        $per = Permission::find($id);

        $request->validate([
            'name' => 'required',

        ]);
        $per->name = $request->name;
        $per->save();
        Toastr::success('Permission updated successfully!');
        return redirect('admin/permission/list');
    }

    public function delete(Request $request)
    {
        $per = Permission::find($request->id);

        $per->delete();
        Toastr::success('Permission removed!');
        return back();
    }
}

