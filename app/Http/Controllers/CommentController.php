<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        //
    }

    public function createComment(Request $request)
    {
        // Validate the incoming request data
        $validator = Validator(
            $request->all(),
            [
                'name' => 'required|max:255',
                'email' => 'required|email|max:255',
                'website' => 'nullable|max:255',
                'comment' => 'required',
            ],
            [
                'name.required' => 'Name is required',
                'name.max' => 'Name must be less than 255 characters',
                'email.required' => 'Email is required',
                'email.email' => 'Email must be a valid email address',
                'comment.required' => 'Comment is required',
                'website.max' => 'Website must be less than 255 characters',
            ],
        );

        if($validator->fails()){
            return response()->json($validator->errors()->first(), 400);
        }


        // Create a new comment using the Comment model
        $comment = new Comment();
        $comment->post_id = $request->post_id;
        $comment->name = $request->name;
        $comment->email = $request->email;
        $comment->website = $request->website;
        $comment->comment = $request->comment;
        $comment->save();

        // You can add more logic here like sending notifications or returning a response.

        return response()->json(['message' => 'Comment submitted successfully']);
    }
}
