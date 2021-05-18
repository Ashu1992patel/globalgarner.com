<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function welcome()
    {
        $products = Product::latest()->paginate(9);
        $categories = Category::cursor();
        return  view('welcome', compact('products', 'categories'));
    }
}
