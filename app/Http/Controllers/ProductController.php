<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::sortable()->auth()->paginate(9);
        $categories = Category::cursor();
        return  view('components.product.index', compact('products', 'categories'));
    }

    public function search(Request $request)
    {
        $sortby = $request->sortby ?? 'title';
        $search = $request->search;
        $categories = $request->categories;
        $price = $request->price;
        $rating = $request->rating;
        $stock = $request->stock;
        $sorttype = $request->get('sorttype') ?? 'asc';

        $products = Product::query();

        if (isset($categories)) {
            $products->whereIn('category_id', $categories);
        }
        if (isset($price)) {
            $products->where('price', '<=', $price);
        }
        if (isset($rating)) {
            $products->where('rating', '>=', $rating);
        }
        if (isset($stock)) {
            $products->where('stock', $stock);
        }
        if (isset($search)) {
            $products->where('title', 'LIKE', '%' . $search . '%');
        }
        $products  = $products
            ->orderBy($sortby, $sorttype)
            ->paginate(9);

        return view('components.product.search', compact('products'));
    }

    public function isLiked(Product $product, Request $request)
    {
        $product->update([
            'likes' => $product->likes + 1,
        ]);
        return $product->likes;
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('components.product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        try {
            Product::create([
                'image' => $request->image,
                'title' => $request->title,
                'rating' => $request->rating,
                'price' => $request->price,
                'category_id' => $request->categories,
                'description' => $request->description,
                'stock' => $request->stock,
                'user_id' => auth()->id(),
            ]);
            return redirect()->route('products.create')->with('success', __('message.success'));
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->route('products.create')->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return  view('components.product.show', compact('product'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('components.product.edit', compact('categories', 'product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {
        try {
            $product->update([
                'image' => $request->image,
                'title' => $request->title,
                'rating' => $request->rating,
                'price' => $request->price,
                'category_id' => $request->categories,
                'description' => $request->description,
                'stock' => $request->stock,
            ]);
            return redirect()->route('products.index')->with('success', __('message.update'));
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->route('products.create')->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')
            ->with('success', __('message.delete'));
    }
}
