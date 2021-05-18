<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CustomController extends Controller
{
    function index()
    {
     $data = DB::table('post')->orderBy('id', 'asc')->paginate(5);
     return view('pagination', compact('data'));
    }

    function fetch_data(Request $request)
    {
     if($request->ajax())
     {
      $sort_by = $request->get('sortby');
      $sort_type = $request->get('sorttype');
            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);
      $data = DB::table('post')
                    ->where('id', 'like', '%'.$query.'%')
                    ->orWhere('post_title', 'like', '%'.$query.'%')
                    ->orWhere('post_description', 'like', '%'.$query.'%')
                    ->orderBy($sort_by, $sort_type)
                    ->paginate(5);
      return view('pagination_data', compact('data'))->render();
     }
    }
    
    public function trash()
    {
        $products = Product::onlyTrashed()->get();
        return  view('components.product.trash', compact('products'));
    }

    #   restore method
    public function restore($product_id)
    {
        try {
            $products = Product::onlyTrashed()->find($product_id)->restore();
            return redirect()->route('products.trash')->with('success', 'Product has been restored successfully!!');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->route('products.trash')->with('error', 'Oops!! Product could not restored!!');
        }
    }

    public function destroyPermanent($product_id)
    {
        try {
            Product::onlyTrashed()->find($product_id)->forceDelete();
            return redirect()->route('products.index')->with('success', 'Product has been removed permaently successfully!!');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->route('products.trash')->with('error', 'Oops!! Product could not removed!!');
        }
    }

    public function showTrashed(Product $product, $product_id)
    {
        $product =  Product::onlyTrashed()->find($product_id);
        return  view('components.product.show', compact('product'));
    }
}
