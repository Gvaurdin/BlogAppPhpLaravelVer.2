<?php

namespace App\Http\Controllers\Controllers;
use Illuminate\Routing\Controller;

class CategoriesController extends Controller
{
    public function index()
    {
        return view('categories.index');
    }

    public function show($id)
    {
        return view('categories.show', ['id' => $id]);
    }
}
