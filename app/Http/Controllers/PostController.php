<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Media;
use App\Models\Post;
use App\Models\PostStatus;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    // View
    protected $view = 'posts.';

    // Route
    protected $route = 'dashboard/posts';
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;

        // Query for posts
        $query = Post::query();

        if ($search) {
            $query->where('title', 'like', '%' . $search . '%');
        }

        $posts = $query->orderBy('created_at', 'desc')->paginate(10);

        return view($this->view . 'index', compact('posts', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $postStatuses = PostStatus::where('is_active', 1)->get();
        $categories = Category::where('is_active', 1)->get();
        $tags = Tag::where('is_active', 1)->get();
        return view(
            $this->view . 'create',
            compact(
                'postStatuses',
                'categories',
                'tags'
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'title' => 'required|max:255',
                'slug' => 'required|max:255|regex:/^[a-z0-9\-]+$/',
                'summary' => 'required|max:255',
                'description' => 'required',
                'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust file types and size as needed
                'meta_title' => 'required|max:255',
                'meta_description' => 'required|max:255',
                'meta_keywords' => 'nullable|string|max:255',
                'post_status_id' => 'required|exists:post_statuses,id',
                'category_id' => 'required|exists:categories,id',
                'tag_ids.*' => 'exists:tag,id',
            ],
            [
                'title.required' => 'Title is required.',
                'title.max' => 'Maximum length title can be 255 characters.',
                'slug.required' => 'Slug is required.',
                'slug.max' => 'Maximum length slug can be 255 characters.',
                'slug.regex' => 'Only alphanumeric and hypen is allowed in slug.',
                'summary.required' => 'Summary is required.',
                'summary.max' => 'Maximum length summary can be 255 characters.',
                'description.required' => 'Post description is required.',
                'featured_image.image' => 'This should be image',
                'meta_title.required' => 'Meta Title is required.',
                'meta_title.max' => 'Maximum length meta title can be 255 characters.',
                'meta_description.required' => 'Meta Description is required.',
                'meta_description.max' => 'Maximum length meta description can be 255 characters.',
                'meta_keywords.max' => 'Maximum length meta keywors can be 255 characters.',
                'post_status_id.required' => 'Post Status is required.',
                'post_status_id.exists' => 'Invalid post status selected.',
                'category_id.required' => 'Category is required.',
                'category_id.exists' => 'Invalid category selected.',
                'tag_ids.*.exists' => 'One or more tag does not exists.',
            ],
        );

        if ($validator->fails()) {
            Session::flash('error', [
                'text' => $validator->errors()->first(),
            ]);
            return back()->withInput();
        }


        $userId = Auth::user()->id;

        $data = new Post();
        $data->post_status_id = $request->post_status_id;
        $data->title = $request->title;
        $data->slug = $request->slug;
        $data->summary = $request->summary;
        $data->description = $request->description;
        $data->meta_title = $request->meta_title;
        $data->meta_description = $request->meta_description;
        $data->meta_keywords = $request->meta_keywords;
        $data->published_at = now();
        $data->created_by = $userId;
        $data->updated_by = $userId;

        if (!empty($request->is_featured)) {
            $data->is_featured = 1;
        } else {
            $data->is_featured = 0;
        }

        if (!empty($request->is_comment)) {
            $data->is_comment = 1;
        } else {
            $data->is_comment = 0;
        }

        // Modify the category_id handling to convert it to a string
        if ($request->has('category_id') && is_array($request->category_id)) {
            $categoryString = implode(',', $request->category_id);
            $data->category_id = $categoryString;
        } else {
            $data->category_id = null; // Set it to null if no tags are selected
        }

        // Modify the tag_id handling to convert it to a string
        if ($request->has('tag_id') && is_array($request->tag_id)) {
            $tagsString = implode(',', $request->tag_id);
            $data->tag_id = $tagsString;
        } else {
            $data->tag_id = null; // Set it to null if no tags are selected
        }

        // Handle the featured image upload
        $imageName = null; // Initialize imageName to null

        if ($request->hasFile('featured_image')) {
            $uploadedFile = $request->file('featured_image');
            // Make sure a file was successfully uploaded
            if ($uploadedFile) {
                $imageName = time() . '_' . $uploadedFile->getClientOriginalName();
                $uploadedFile->move(public_path('images'), $imageName);
                // Create a new media record in the database
                $media = new Media();
                $media->media_categories_id = 1;
                $media->media = $imageName;
                $media->save();
            }
        }
        $data->featured_image = $imageName;

        // return $data;
        $result = $data->save();

        if ($result) {
            Session::flash('message', [
                'text' => 'Post is updated',
            ]);
            return redirect($this->route);
        } else {
            Session::flash('error', [
                'text' => 'Failed to update post, please try again later.'
            ]);
            return back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Post::find($id);

        if ($data) {
            return redirect($this->route . '/' . $id . '/edit');
        } else {
            Session::flash('error', [
                'text' => 'Post could not be found.'
            ]);
            return redirect($this->route);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $postStatuses = PostStatus::where('is_active', 1)->get();
        $categories = Category::where('is_active', 1)->get();
        $tags = Tag::where('is_active', 1)->get();
        $data = Post::find($id);
        return view(
            $this->view . 'edit',
            compact(
                'postStatuses',
                'categories',
                'tags',
                'data'
            )
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        {
            $validator = Validator::make(
                $request->all(),
                [
                    'title' => 'required|max:255',
                    'slug' => 'required|max:255|regex:/^[a-z0-9\-]+$/',
                    'summary' => 'required|max:255',
                    'description' => 'required',
                    'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust file types and size as needed
                    'meta_title' => 'required|max:255',
                    'meta_description' => 'required|max:255',
                    'meta_keywords' => 'nullable|string|max:255',
                    'post_status_id' => 'required|exists:post_statuses,id',
                    'category_id' => 'required|exists:categories,id',
                    'tag_ids.*' => 'exists:tag,id',
                ],
                [
                    'title.required' => 'Title is required.',
                    'title.max' => 'Maximum length title can be 255 characters.',
                    'slug.required' => 'Slug is required.',
                    'slug.max' => 'Maximum length slug can be 255 characters.',
                    'slug.regex' => 'Only alphanumeric and hypen is allowed in slug.',
                    'summary.required' => 'Summary is required.',
                    'summary.max' => 'Maximum length summary can be 255 characters.',
                    'description.required' => 'Post description is required.',
                    'featured_image.image' => 'This should be image',
                    'meta_title.required' => 'Meta Title is required.',
                    'meta_title.max' => 'Maximum length meta title can be 255 characters.',
                    'meta_description.required' => 'Meta Description is required.',
                    'meta_description.max' => 'Maximum length meta description can be 255 characters.',
                    'meta_keywords.max' => 'Maximum length meta keywors can be 255 characters.',
                    'post_status_id.required' => 'Post Status is required.',
                    'post_status_id.exists' => 'Invalid post status selected.',
                    'category_id.required' => 'Category is required.',
                    'category_id.exists' => 'Invalid category selected.',
                    'tag_ids.*.exists' => 'One or more tag does not exists.',
                ],
            );
    
            if ($validator->fails()) {
                Session::flash('error', [
                    'text' => $validator->errors()->first(),
                ]);
                return back()->withInput();
            }
    
    
            $userId = Auth::user()->id;
    
            $data = Post::find($id);
            $data->post_status_id = $request->post_status_id;
            $data->title = $request->title;
            $data->slug = $request->slug;
            $data->summary = $request->summary;
            $data->description = $request->description;
            $data->meta_title = $request->meta_title;
            $data->meta_description = $request->meta_description;
            $data->meta_keywords = $request->meta_keywords;
            $data->published_at = now();
            $data->created_by = $userId;
            $data->updated_by = $userId;
    
            if (!empty($request->is_featured)) {
                $data->is_featured = 1;
            } else {
                $data->is_featured = 0;
            }
    
            if (!empty($request->is_comment)) {
                $data->is_comment = 1;
            } else {
                $data->is_comment = 0;
            }
    
            // Modify the category_id handling to convert it to a string
            if ($request->has('category_id') && is_array($request->category_id)) {
                $categoryString = implode(',', $request->category_id);
                $data->category_id = $categoryString;
            } else {
                $data->category_id = null; // Set it to null if no tags are selected
            }
    
            // Modify the tag_id handling to convert it to a string
            if ($request->has('tag_id') && is_array($request->tag_id)) {
                $tagsString = implode(',', $request->tag_id);
                $data->tag_id = $tagsString;
            } else {
                $data->tag_id = null; // Set it to null if no tags are selected
            }
    
            // Handle the featured image upload
            $imageName = null; // Initialize imageName to null
    
            if ($request->hasFile('featured_image')) {
                $uploadedFile = $request->file('featured_image');
                // Make sure a file was successfully uploaded
                if ($uploadedFile) {
                    $imageName = time() . '_' . $uploadedFile->getClientOriginalName();
                    $uploadedFile->move(public_path('images'), $imageName);
                    // Create a new media record in the database
                    $media = new Media();
                    $media->media_categories_id = 1;
                    $media->media = $imageName;
                    $media->save();
                }
            }
            $data->featured_image = $imageName;
    
            // return $data;
            $result = $data->save();
    
            if ($result) {
                Session::flash('message', [
                    'text' => 'Post is updated',
                ]);
                return redirect($this->route);
            } else {
                Session::flash('error', [
                    'text' => 'Failed to update post, please try again later.'
                ]);
                return back()->withInput();
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Delete post
        $post = Post::find($id);
        if ($post) {
            $post->delete();
            Session::flash('message', [
                'text' => 'Post is deleted',
            ]);
            return redirect($this->route);
        } else {
            Session::flash('error', [
                'text' => 'Failed to delete post, please try again later.'
            ]);
            return back()->withInput();
        }
    }
}
