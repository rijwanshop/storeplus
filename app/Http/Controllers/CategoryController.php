<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::get();
        return response()->json([
            'message' => 'Show all categories!',
            'data' => $categories
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function table()
    {
        $categories = Category::paginate(10);
        return view('category.index', compact('categories'));
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
    public function store(StoreCategoryRequest $request)
    {
        $name = $request->input('name');
        $enable = $request->boolean('enable', false);

        $category = Category::create([
            'name' => $name,
            'enable' => $enable
        ]);

        return response()->json([
            'message' => 'Category has been created!',
            'data' => $category
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return response()->json([
            'message' => 'Show category',
            'data' => $category
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $name = $request->input('name');
        $enable = $request->boolean('enable', $category->enable);

        $category->update([
            'name' => $name,
            'enable' => $enable
        ]);

        return response()->json([
            'message' => 'Category has been updated!',
            'data' => $category
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return response()->json([
            'message' => 'Category has been deleted!',
            'data' => null
        ]);
    }
}
