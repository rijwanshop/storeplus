<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Image\StoreImageRequest;
use App\Http\Requests\Image\UpdateImageRequest;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $images = Image::get();
        return response()->json([
            'message' => 'Show all images!',
            'data' => $images
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function table()
    {
        $images = Image::paginate(10);
        return view('files.index', compact('images'));
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
    public function store(StoreImageRequest $request)
    {
        $name = $request->input('name');
        $enable = $request->boolean('enable');

        /** Set default image */
        $file = asset('images/produk/produk1.jpg');
        if($request->hasFile('file')) {
            $file = $request->file('file')->store('images');
            $file = Storage::url($file);
        }

        $image = Image::create([
            'name' => $name,
            'file' => $file,
            'enable' => $enable
        ]);

        return response()->json([
            'message' => 'Image has been created!',
            'data' => $image
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Image $image)
    {
        return response()->json([
            'message' => 'Show Image',
            'data' => $image
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Image $image)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateImageRequest $request, Image $image)
    {
        $name = $request->input('name');
        $enable = $request->boolean('enable');

        /** Set default image */
        $file = $image->file;
        if($request->hasFile('file')) {
            $file = $request->file('file')->store('images');
            $file = Storage::url($file);
        }

        $image->update([
            'name' => $name,
            'file' => $file,
            'enable' => $enable
        ]);

        return response()->json([
            'message' => 'Image has been updated!',
            'data' => $image
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Image $image)
    {
        $image->delete();

        return response()->json([
            'message' => 'Image has been deleted!',
            'data' => null
        ]);
    }
}
