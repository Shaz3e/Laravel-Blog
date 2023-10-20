<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class PostStatusController extends Controller
{
    // View
    protected $view = 'post-statuses.';

    // Route
    protected $route = 'dashboard/post-statuses';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataSet = PostStatus::all();
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
                'name' => 'required|max:255|unique:post_statuses,name',
                'is_active' => 'required|boolean',
            ],
            [
                'name.required' => 'Post Status is required.',
                'name.max' => 'Post Status must not be greater than 255 characters.',
                'name.unique' => 'Post Status already exists.',
                'is_active.required' => 'Post Status is required.',
                'is_active.boolean' => 'Post Status is invalid.',
            ],
        );

        if ($validator->fails()) {
            Session::flash('error', [
                'text' => $validator->errors()->first(),
            ]);
            return redirect()->back()->withInput();
        }

        $data = new PostStatus();
        $data->name = $request->name;
        $data->is_active = $request->is_active;
        $result = $data->save();

        if ($result) {
            Session::flash('message', [
                'text' => 'Post status has been created.'
            ]);
            return redirect($this->route);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = PostStatus::find($id);

        if ($data) {
            return view($this->view . '/' . $id . 'edit');
        } else {
            Session::flash('error', [
                'text' => 'Post status could not be found.'
            ]);
            return redirect($this->route);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $data = PostStatus::find($id);

        if ($data) {
            return view($this->view . 'edit', compact('data'));
        } else {
            Session::flash('error', [
                'text' => 'Post status could not be found.'
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
                'name' => 'required|max:255|unique:post_statuses,name,' . $id,
                'is_active' => 'required|boolean',
            ],
            [
                'name.required' => 'Post Status name is required.',
                'name.max' => 'Post Status must not be greater than 255 characters.',
                'name.unique' => 'Post Status already exists.',
                'is_active.required' => 'Post Status is required.',
                'is_active.boolean' => 'Post Status is invalid.',
            ],
        );

        if($validator->fails()){
            Session::flash('error', [
                'text' => $validator->errors()->first(),
            ]);
            return redirect()->back()->withInput();
        }

        $data = PostStatus::find($id);
        $data->name = $request->name;
        $data->is_active = $request->is_active;

        $result = $data->save();

        if($result){
            Session::flash('message', [
                'text' => 'Post status has been updated.'
            ]);
            return redirect($this->route);
        }else{
            Session::flash('error', [
                'text' => 'Post status could not be updated.'
            ]);
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (PostStatus::where('id', $id)->exists()) {
            $result = PostStatus::destroy($id);
            if ($result) {
                Session::flash('message', [
                    'text' => 'Post status has been deleted.'
                ]);
                return redirect($this->route);
            } else {
                Session::flash('error', [
                    'text' => 'Post status could not be deleted.'
                ]);
                return redirect()->back();
            }
        } else {
            Session::flash('error', [
                'text' => 'Post status could not be found.'
            ]);
            return redirect()->back();
        }
    }
}
