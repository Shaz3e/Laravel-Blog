<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    // View
    protected $view = 'permissions.';

    // Route
    protected $route = 'dashboard/permissions';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissions = Permission::all();
        return view($this->view . 'index', compact('permissions'));
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
                'name' => 'required|max:255|unique:permissions,name',
            ],
            [
                'name.required' => 'Permission Name is required',
                'name.unique' => 'Permission Name already exists',
                'name.max' => 'Permission Name must be less than 255 characters',
            ],
        );

        if ($validator->fails()) {
            Session::flash('error', [
                'text' => $validator->errors()->first(),
            ]);
            return redirect()->back()->withInput();
        }

        $data = new Permission();
        $data->name = $request->name;

        $result = $data->save();

        if ($result) {
            Session::flash('success', [
                'text' => 'Permission created successfully',
            ]);
            return redirect($this->route);
        } else {
            Session::flash('error', [
                'text' => 'Permission creation failed',
            ]);
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Permission::find($id);

        if ($data) {
            return view($this->view . '/' . $id . 'edit');
        } else {
            Session::flash('error', [
                'text' => 'Permission could not be found.'
            ]);
            return redirect($this->route);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Permission::find($id);

        if ($data) {
            return view($this->view . 'edit', compact(
                'data',
            ));
        } else {
            Session::flash('error', [
                'text' => 'Permission could not be found.'
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
                'name' => 'required|max:255|unique:permissions,name',
            ],
            [
                'name.required' => 'Permission Name is required',
                'name.unique' => 'Permission Name already exists',
                'name.max' => 'Permission Name must be less than 255 characters',
            ],
        );

        if ($validator->fails()) {
            Session::flash('error', [
                'text' => $validator->errors()->first(),
            ]);
            return redirect()->back()->withInput();
        }

        $data = Permission::find($id);
        $data->name = $request->name;

        $result = $data->save();

        if ($result) {
            Session::flash('success', [
                'text' => 'Permission created successfully',
            ]);
            return redirect($this->route);
        } else {
            Session::flash('error', [
                'text' => 'Permission creation failed',
            ]);
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        if (Permission::where('id', $id)->exists()) {
            $result = Permission::destroy($id);
            if ($result) {
                Session::flash('message', [
                    'text' => 'Permission has been deleted.'
                ]);
                return redirect($this->route);
            } else {
                Session::flash('error', [
                    'text' => 'Permission could not be deleted.'
                ]);
                return redirect()->back();
            }
        } else {
            Session::flash('error', [
                'text' => 'Permission could not be found.'
            ]);
            return redirect()->back();
        }
    }
}
