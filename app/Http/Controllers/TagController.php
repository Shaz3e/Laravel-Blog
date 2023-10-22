<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class TagController extends Controller
{
    // View
    protected $view = 'tags.';

    // Route
    protected $route = 'dashboard/tags';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataSet = Tag::all();
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
                'name' => 'required|max:255|unique:tags,name',
                'slug' => 'required|max:255|unique:tags,slug',
                'is_active' => 'required|boolean',
            ],
            [
                'name.required' => 'Tag is required.',
                'name.max' => 'Tag must not be greater than 255 characters.',
                'name.unique' => 'Tag already exists.',
                'slug.required' => 'Tag slug is required.',
                'slug.max' => 'Tag slug must not be greater than 255 characters.',
                'slug.unique' => 'Tag slug already exists.',
                'is_active.required' => 'Tag is required.',
                'is_active.boolean' => 'Tag is invalid.',
            ],
        );

        if ($validator->fails()) {
            Session::flash('error', [
                'text' => $validator->errors()->first(),
            ]);
            return redirect()->back()->withInput();
        }

        $data = new Tag();
        $data->name = $request->name;
        $data->slug = $request->slug;
        $data->is_active = $request->is_active;
        $result = $data->save();

        if ($result) {
            Session::flash('message', [
                'text' => 'Tag has been created.'
            ]);
            return redirect($this->route);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Tag::find($id);

        if ($data) {
            return redirect($this->route . '/' . $id . '/edit');
        } else {
            Session::flash('error', [
                'text' => 'Tag could not be found.'
            ]);
            return redirect($this->route);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Tag::find($id);

        if ($data) {
            return view($this->view . 'edit', compact('data'));
        } else {
            Session::flash('error', [
                'text' => 'Tag could not be found.'
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
                'name' => 'required|max:255|unique:tags,name,' . $id,
                'slug' => 'required|max:255|unique:tags,slug,' . $id,
                'is_active' => 'required|boolean',
            ],
            [
                'name.required' => 'Tag name is required.',
                'name.max' => 'Tag must not be greater than 255 characters.',
                'name.unique' => 'Tag already exists.',
                'slug.required' => 'Tag slug is required.',
                'slug.max' => 'Tag slug must not be greater than 255 characters.',
                'slug.unique' => 'Tag slug already exists.',
                'is_active.required' => 'Tag is required.',
                'is_active.boolean' => 'Tag is invalid.',
            ],
        );

        if ($validator->fails()) {
            Session::flash('error', [
                'text' => $validator->errors()->first(),
            ]);
            return redirect()->back()->withInput();
        }

        $data = Tag::find($id);
        $data->name = $request->name;
        $data->slug = $request->slug;
        $data->is_active = $request->is_active;

        $result = $data->save();

        if ($result) {
            Session::flash('message', [
                'text' => 'Tag has been updated.'
            ]);
            return redirect($this->route);
        } else {
            Session::flash('error', [
                'text' => 'Tag could not be updated.'
            ]);
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (Tag::where('id', $id)->exists()) {
            $result = Tag::destroy($id);
            if ($result) {
                Session::flash('message', [
                    'text' => 'Tag has been deleted.'
                ]);
                return redirect($this->route);
            } else {
                Session::flash('error', [
                    'text' => 'Tag could not be deleted.'
                ]);
                return redirect()->back();
            }
        } else {
            Session::flash('error', [
                'text' => 'Tag could not be found.'
            ]);
            return redirect()->back();
        }
    }

    public function createRecord(Request $request)
    {
        // Get the input value from the request
        $inputTag = $request->input('inputTag');

        // Split the input value by commas
        $values = explode(',', $inputTag);

        $createdTagIds = [];

        foreach ($values as $value) {
            // Remove leading/trailing spaces and convert to lowercase
            $trimmedValue = strtolower(trim($value));

            // Check if a tag with the same name exists
            $existingTag = Tag::where('name', $trimmedValue)->first();

            if (!$existingTag) {
                // Create and save a new record in the database
                $record = new Tag();
                $record->name = $trimmedValue;
                $record->slug = $this->generateSlug($trimmedValue, '-'); // Generate the slug
                $record->save();

                $createdTagIds[] = $record->id;
            } else {
                $createdTagIds[] = $existingTag->id;
            }
        }

        // Retrieve the tags created or found by IDs
        $createdTags = Tag::whereIn('id', $createdTagIds)->get();

        return response()->json(['message' => 'Records created successfully', 'tags' => $createdTags]);
    }

    private function generateSlug($text)
    {
        // Replace spaces and special characters with hyphens
        $slug = preg_replace('/[^\p{L}\p{N}]+/u', '-', $text);

        // Remove leading/trailing hyphens
        $slug = trim($slug, '-');

        // Convert to lowercase
        $slug = mb_strtolower($slug, 'UTF-8');

        return $slug;
    }
}
