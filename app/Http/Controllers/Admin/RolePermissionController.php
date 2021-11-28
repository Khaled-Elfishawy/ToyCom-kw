<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Permission;
use App\Model\Role;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RolePermissionController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        $permissions = Permission::all();

        return view('admin-views.role-per.index', compact('permissions','roles'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required|unique:roles']);

        if( Role::create($request->only('name')) ) {
            return redirect()->back()->with('success','Role Added');
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        if($role = Role::findOrFail($id)) {
            // admin role has everything
            if($role->name === 'Super Admin') {
                $role->syncPermissions(Permission::all());
                return redirect()->route('admin.rolePer.add-new');
            }


            $permissions = $request->get('permissions', []);

            $role->syncPermissions($permissions);

            Toastr::success('permissions has been updated!');

        } else {
            Toastr::success('permissions has been updated!');
        }

        return redirect()->route('admin.rolePer.add-new');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table("roles")->where('id',$id)->delete();
        return redirect()->back()->with('success','Role deleted successfully');
    }

}

