<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\MediaCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class MediaController extends Controller
{
    // View
    protected $view = 'media.';

    // Route
    protected $route = 'dashboard/media';

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Calculate the count of associated media for each media_categories_id
        $countMediaByCategory = Media::select('media_categories_id', DB::raw('count(*) as count'))
            ->groupBy('media_categories_id')
            ->pluck('count', 'media_categories_id');
        $categories = MediaCategory::all();

        if ($request->category != null) {
            $media = Media::where('media_categories_id', $request->category)->get();
        } else {
            $media = Media::all();
        }
        return view(
            $this->view . 'index',
            compact(
                'countMediaByCategory',
                'categories',
                'media'
            )
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $media_categories = MediaCategory::where('is_active', 1)->get();
        return view($this->view . 'create', compact('media_categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'media_categories_id' => 'required|exists:media_categories,id',
            'file.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust file types and size as needed
        ]);

        $mediaCategoryId = $request->input('media_categories_id');
        $files = $request->file('file');

        if ($files && is_array($files)) {
            foreach ($files as $file) {
                // Generate a unique image name
                // $imageName = time() . '_' . $file->getClientOriginalName();
                $imageName = time() . '_' . str_replace(' ', '-', $file->getClientOriginalName());

                // Move the image to the images folder
                $file->move(public_path('images'), $imageName);

                // Create a new media record in the database
                $media = new Media();
                $media->media_categories_id = $mediaCategoryId;
                $media->media = $imageName;
                $media->save();
            }
        }
        return response()->json(['success' => true, 'message' => 'Media uploaded successfully']);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $media = Media::find($id);

        if ($media) {
            $filePath = 'images/' . $media->media;

            if (File::exists(public_path($filePath))) {
                File::delete(public_path($filePath));
            }

            $media->delete();

            Session::flash('message', [
                'text' => "Media Deleted Successfully",
            ]);

            return redirect($this->route);
        }

        Session::flash('error', [
            'text' => 'Media not found',
        ]);
    }
}
