<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CategoryType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    // View
    protected $view = 'categories.';

    // Route
    protected $route = 'dashboard/categories';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataSet = Category::select(
            'categories.*',
            'category_types.name as type'
        )
        ->leftJoin('category_types', 'category_types.id', 'categories.category_type_id')
        ->get();
        return view($this->view . 'index', compact('dataSet'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categoryTypes = CategoryType::where('is_active', 1)->get();
        $categories = Category::all();
        return view($this->view . 'create', compact('categoryTypes', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'category_type_id' => 'required',
                'name' => 'required|max:255|unique:categories,name',
                'slug' => 'required|max:255|unique:categories,slug',
                'is_active' => 'required|boolean',
            ],
            [
                'category_type_id.required' => 'Category type is required.',
                'name.required' => 'Category is required.',
                'name.max' => 'Category must not be greater than 255 characters.',
                'name.unique' => 'Category already exists.',
                'slug.required' => 'Category slug is required.',
                'slug.max' => 'Category slug must not be greater than 255 characters.',
                'slug.unique' => 'Category slug already exists.',
                'is_active.required' => 'Category is required.',
                'is_active.boolean' => 'Category is invalid.',
            ],
        );

        if ($validator->fails()) {
            Session::flash('error', [
                'text' => $validator->errors()->first(),
            ]);
            return redirect()->back()->withInput();
        }

        $data = new Category();
        $data->category_type_id = $request->category_type_id;
        $data->parent_category_id = $request->parent_category_id;
        $data->name = $request->name;
        $data->slug = $request->slug;
        $data->is_active = $request->is_active;

        $result = $data->save();

        if ($result) {
            Session::flash('message', [
                'text' => 'Category has been created.'
            ]);
            return redirect($this->route);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Category::find($id);

        if ($data) {
            return view($this->view . '/' . $id . 'edit');
        } else {
            Session::flash('error', [
                'text' => 'Category could not be found.'
            ]);
            return redirect($this->route);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categoryTypes = CategoryType::where('is_active', 1)->get();
        $data = Category::find($id);

        if ($data) {
            return view($this->view . 'edit', compact('data', 'categoryTypes'));
        } else {
            Session::flash('error', [
                'text' => 'Catgory could not be found.'
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
                'category_type_id' => 'required',
                'name' => 'required|max:255|unique:categories,name,' . $id,
                'slug' => 'required|max:255|unique:categories,slug,' . $id,
                'is_active' => 'required|boolean',
            ],
            [
                'category_type_id.required' => 'Category type is required.',
                'name.required' => 'Category name is required.',
                'name.max' => 'Category must not be greater than 255 characters.',
                'name.unique' => 'Category already exists.',
                'slug.required' => 'Category slug is required.',
                'slug.max' => 'Category slug must not be greater than 255 characters.',
                'slug.unique' => 'Category slug already exists.',
                'is_active.required' => 'Category is required.',
                'is_active.boolean' => 'Category is invalid.',
            ],
        );

        if($validator->fails()){
            Session::flash('error', [
                'text' => $validator->errors()->first(),
            ]);
            return redirect()->back()->withInput();
        }

        $data = Category::find($id);
        $data->category_type_id = $request->category_type_id;
        $data->name = $request->name;
        $data->slug = $request->slug;
        $data->is_active = $request->is_active;

        $result = $data->save();

        if($result){
            Session::flash('message', [
                'text' => 'Category has been updated.'
            ]);
            return redirect($this->route);
        }else{
            Session::flash('error', [
                'text' => 'Category could not be updated.'
            ]);
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (Category::where('id', $id)->exists()) {
            $result = Category::destroy($id);
            if ($result) {
                Session::flash('message', [
                    'text' => 'Category has been deleted.'
                ]);
                return redirect($this->route);
            } else {
                Session::flash('error', [
                    'text' => 'Category could not be deleted.'
                ]);
                return redirect()->back();
            }
        } else {
            Session::flash('error', [
                'text' => 'Category could not be found.'
            ]);
            return redirect()->back();
        }
    }
}
