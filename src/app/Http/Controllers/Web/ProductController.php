<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;

class ProductController
{

    public function index(Request $request)
    {
        return view('products.index');
    }

    public function create(Request $request)
    {
        return view('products.create');
    }


}
