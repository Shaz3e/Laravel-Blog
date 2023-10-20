<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    // View
    protected $view = 'roles.';

    // Route
    protected $route = 'dashboard/roles';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();
        return view($this->view . 'index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view($this->view . 'create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|unique:roles,name|max:255',
            ],
            [
                'name.required' => 'Role is required',
                'name.unique' => 'Role already exists',
                'name.max' => 'Role must be less than 255 characters',
            ],
        );

        if ($validator->fails()) {
            Session::flash('error', [
                'text' => $validator->errors()->first(),
            ]);
            return redirect()->back()->withInput();
        }

        $result = Role::create(['name' => $request->name]);

        if ($result) {
            Session::flash('success', [
                'text' => 'Role created successfully',
            ]);
            return redirect($this->route);
        } else {
            Session::flash('error', [
                'text' => 'Role creation failed',
            ]);
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Role::find($id);

        if ($data) {
            return view($this->view . 'edit', compact('data'));
        } else {
            Session::flash('error', [
                'text' => 'Role could not be found.'
            ]);
            return redirect($this->route);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Role::find($id);

        if ($data) {
            $permissions = Permission::all();
            return view($this->view . 'edit', compact(
                'data',
                'permissions'
            ));
        } else {
            Session::flash('error', [
                'text' => 'Role could not be found.'
            ]);
            return redirect($this->route);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|max:255|unique:roles,name,' . $id,
            ],
            [
                'name.required' => 'Role is required',
                'name.unique' => 'Role already exists',
                'name.max' => 'Role must be less than 255 characters',
            ],
        );

        if ($validator->fails()) {
            Session::flash('error', [
                'text' => $validator->errors()->first(),
            ]);
            return redirect()->back()->withInput();
        }

        $result = Role::find($id)->update(['name' => $request->name]);

        if ($result) {
            Session::flash('success', [
                'text' => 'Role updated successfully',
            ]);
            return redirect($this->route);
        } else {
            Session::flash('error', [
                'text' => 'Role update failed',
            ]);
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(string $id)
    // {
    //     //
    // }


    public function updatePermissions(Request $request, string $id)
    {
        $role = Role::where('id', $id)->where('guard_name', 'web')->first();

        if (!$role) {
            // Handle the case where the role is not found
            Session::flash('error', [
                'text' => 'The requested record was not found.'
            ]);
            return redirect($this->route);
        }

        // Decode JSON into an array
        $permissions = json_decode($request->input('permissions'), true);

        if (!is_array($permissions)) {
            // Handle the case where permissions is not an array
            // For example, you can set it to an empty array
            $permissions = [];
        }

        // Detach all permissions from the role
        $role->permissions()->sync([]);

        // Attach the selected permissions to the role
        foreach ($permissions as $permission) {
            // Check if the permission exists for the 'admin' guard
            $perm = Permission::where('name', $permission)->where('guard_name', 'web')->first();

            if ($perm) {
                $role->givePermissionTo($perm);
            }
        }

        Session::flash('success', [
            'text' => 'Permissions have been updated.',
        ]);

        return redirect($this->route);
    }
}
