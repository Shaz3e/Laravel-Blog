<?php

namespace App\Http\Controllers;

use App\Models\MediaCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class MediaCategoryController extends Controller
{
    // View
    protected $view = 'media-categories.';

    // Route
    protected $route = 'dashboard/media-categories';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataSet = MediaCategory::all();
        return view($this->view . 'index', compact('dataSet'));
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
                'name' => 'required|max:255|unique:media_categories,name',
                'is_active' => 'required|boolean',
            ],
            [
                'name.required' => 'Media Category is required.',
                'name.max' => 'Media Category must not be greater than 255 characters.',
                'name.unique' => 'Media Category already exists.',
                'is_active.required' => 'Media Category is required.',
                'is_active.boolean' => 'Media Category is invalid.',
            ],
        );

        if ($validator->fails()) {
            Session::flash('error', [
                'text' => $validator->errors()->first(),
            ]);
            return redirect()->back()->withInput();
        }

        $data = new MediaCategory();
        $data->name = $request->name;
        $data->is_active = $request->is_active;
        $result = $data->save();

        if ($result) {
            Session::flash('message', [
                'text' => 'Media Category has been created.'
            ]);
            return redirect($this->route);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = MediaCategory::find($id);

        if ($data) {
            return view($this->view . '/' . $id . 'edit');
        } else {
            Session::flash('error', [
                'text' => 'Media Category could not be found.'
            ]);
            return redirect($this->route);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = MediaCategory::find($id);

        if ($data) {
            return view($this->view . 'edit', compact('data'));
        } else {
            Session::flash('error', [
                'text' => 'Media Category could not be found.'
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
                'name' => 'required|max:255|unique:media_categories,name,' . $id,
                'is_active' => 'required|boolean',
            ],
            [
                'name.required' => 'Media Category name is required.',
                'name.max' => 'Media Category must not be greater than 255 characters.',
                'name.unique' => 'Media Category already exists.',
                'is_active.required' => 'Media Category is required.',
                'is_active.boolean' => 'Media Category is invalid.',
            ],
        );

        if($validator->fails()){
            Session::flash('error', [
                'text' => $validator->errors()->first(),
            ]);
            return redirect()->back()->withInput();
        }

        $data = MediaCategory::find($id);
        $data->name = $request->name;
        $data->is_active = $request->is_active;

        $result = $data->save();

        if($result){
            Session::flash('message', [
                'text' => 'Media Category has been updated.'
            ]);
            return redirect($this->route);
        }else{
            Session::flash('error', [
                'text' => 'Media Category could not be updated.'
            ]);
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (MediaCategory::where('id', $id)->exists()) {
            $result = MediaCategory::destroy($id);
            if ($result) {
                Session::flash('message', [
                    'text' => 'Media Category has been deleted.'
                ]);
                return redirect($this->route);
            } else {
                Session::flash('error', [
                    'text' => 'Media Category could not be deleted.'
                ]);
                return redirect()->back();
            }
        } else {
            Session::flash('error', [
                'text' => 'Media Category could not be found.'
            ]);
            return redirect()->back();
        }
    }
}
