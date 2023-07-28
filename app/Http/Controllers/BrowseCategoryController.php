<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class BrowseCategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all()->orderBy('name', 'ASC')->get();

        return view('layouts.app', compact('categories'));
    }
}
