<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Product;
use App\Models\Category;
use App\Http\Resources\ProductResource;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with(['categories', 'images'])->get();
        return response()->json([
            'message' => 'Show all products!',
            'data' => ProductResource::collection($products)
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function table()
    {
        $products = Product::with(['categories', 'images'])->paginate(10);
        return view('product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::get();
        return view('product.createOrUpdate', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $name = $request->input('name');
        $description = $request->input('description');
        $enable = $request->boolean('enable');

        $product = Product::create([
            'name' => $name,
            'description' => $description,
            'enable' => $enable
        ]);

        if($request->hasFile('file')) {
            $file = $request->file('file')->store('images');
            $file = Storage::url($file);

            $image = Image::create([
                'name' => $name,
                'file' => $file,
                'enable' => $enable
            ]);

            $product->images()->sync($image);
        }

        $category = $request->input('category');
        if($category) {
            $product->categories()->sync($category);
        }

        return response()->json([
            'message' => 'Product has been created!',
            'data' => $product
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $product->load(['categories', 'images']);
        return response()->json([
            'message' => 'Show product!',
            'data' => new ProductResource($product)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::get();
        return view('product.createOrUpdate', compact('categories', 'product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $name = $request->input('name');
        $description = $request->input('description');
        $enable = $request->boolean('enable');

        $product->update([
            'name' => $name,
            'description' => $description,
            'enable' => $enable
        ]);

        if($request->hasFile('file')) {
            $file = $request->file('file')->store('images');
            $file = Storage::url($file);

            $image = Image::create([
                'name' => $name,
                'file' => $file,
                'enable' => $enable
            ]);

            $image->products()->sync($product);
        }

        $category = $request->input('category');
        if($category) {
            $product->categories()->sync($category);
        }

        return response()->json([
            'message' => 'Product has been updated!',
            'data' => $product
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json([
            'message' => 'Product has been deleted!',
            'data' => null
        ]);
    }
}
