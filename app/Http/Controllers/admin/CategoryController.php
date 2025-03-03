<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use http\Env\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    public function show(Category $category)
    {
        return view('admin.categories.show', compact('category'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', [
            'category' => $category
        ]);
    }

    public function store(CategoryRequest $request)
    {
        try {
            Category::create($request->validated());
            return redirect()->route('admin.categories.index')->with('success', 'Категория успешно добавлена');
        } catch (\Exception $e) {
            return redirect()->route('admin.categories.create')->with('error', 'Ошибка добавления категории: ' . $e->getMessage());
        }
    }

    public function update(CategoryRequest $request, Category $category)
    {
        try {
            $category->update($request->validated());
            return redirect()->route('admin.categories.index')->with('success', 'Категория успешно обновлена');
        } catch (\Exception $e) {
            return redirect()->route('admin.categories.edit', $category->id)->with('error', 'Ошибка обновления категории: ' . $e->getMessage());
        }
    }

    public function delete(Category $category)
    {
        try {
            $category->delete();
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Ошибка удаления категории : ' .
                    $e->getMessage()
            ],500);
        }

        return response()->json([
            'success' => 'Категория успешно удалена'
        ]);
    }
}
