<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    // View
    protected $view = 'users.';

    // Route
    protected $route = 'dashboard/users';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataSet = User::all();
        return view($this->view . 'index', compact('dataSet'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view($this->view . 'create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|max:255',
                'role_id' => 'required|numeric',
                'is_active' => 'required|boolean',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|max:255',
            ],
            [
                'name.required' => 'User name is requirerd.',
                'name.max' => 'User name should be greater then 255 characters.',
                'role_id.reuiqred' => 'Role is required.',
                'role_id.numeric' => 'Role is invalid.',
                'email.required' => 'Email is required.',
                'email.email' => 'Email is invalid.',
                'email.unique' => 'Email is already exists.',
                'password.required' => 'Password is required exists.',
                'password.max' => 'Password should be greater then 255 characters..',
            ],
        );

        if ($validator->fails()) {
            Session::flash('error', [
                'text' => $validator->errors()->first(),
            ]);
            return redirect()->back()->withInput();
        }

        $data = new User();
        $data->name = $request->name;
        $data->role_id = $request->role_id;
        $data->is_active = $request->is_active;
        $data->email = $request->email;
        $data->password = Hash::make($request->password);

        $role = Role::find($request->role_id);
        $data->assignRole($role);

        $result = $data->save();

        if ($result) {
            Session::flash('message', [
                'text' => 'User has been created.'
            ]);
            return redirect($this->route);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = User::find($id);

        if ($data) {
            return redirect($this->route . '/' . $id . '/edit');
        } else {
            Session::flash('error', [
                'text' => 'User could not be found.'
            ]);
            return redirect($this->route);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $roles = Role::all();
        $data = User::find($id);

        if ($data) {
            return view($this->view . 'edit', compact('data', 'roles'));
        } else {
            Session::flash('error', [
                'text' => 'User could not be found.'
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
                'name' => 'required|max:255',
                'role_id' => 'required|numeric',
                'is_active' => 'required|boolean',
                'email' => 'required|email|unique:users,email,' . $id,
            ],
            [
                'name.required' => 'User name is requirerd.',
                'name.max' => 'User name should be greater then 255 characters.',
                'role_id.reuiqred' => 'Role is required.',
                'role_id.numeric' => 'Role is invalid.',
                'email.required' => 'Email is required.',
                'email.email' => 'Email is invalid.',
                'email.unique' => 'Email is already exists.',
            ],
        );

        if ($validator->fails()) {
            Session::flash('error', [
                'text' => $validator->errors()->first(),
            ]);
            return redirect()->back()->withInput();
        }

        $data = User::find($id);
        $data->email = $request->email;
        $data->name = $request->name;
        $data->role_id = $request->role_id;
        $data->is_active = $request->is_active;

        $role = Role::find($request->role_id);
        $data->roles()->detach();
        $data->assignRole($role);

        $result = $data->save();

        if ($result) {
            Session::flash('message', [
                'text' => 'User has been updated.'
            ]);
            return redirect($this->route);
        } else {
            Session::flash('error', [
                'text' => 'User could not be updated.'
            ]);
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (User::where('id', $id)->exists()) {
            $result = User::destroy($id);
            if ($result) {
                Session::flash('message', [
                    'text' => 'User has been deleted.'
                ]);
                return redirect($this->route);
            } else {
                Session::flash('error', [
                    'text' => 'User could not be deleted.'
                ]);
                return redirect()->back();
            }
        } else {
            Session::flash('error', [
                'text' => 'User could not be found.'
            ]);
            return redirect()->back();
        }
    }
}
