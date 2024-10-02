<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function index()
    {
        $data['products'] = Product::orderBy('id', 'desc')->get();
        return Inertia::render('Products/Index', $data);
    }
}
