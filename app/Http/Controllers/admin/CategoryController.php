<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
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

    public function delete(Category $category)
    {
        return view('admin.categories.delete', ['category' => $category]);
    }

    public function store(Request $request)
    {
        //если запрос post на создание
        if($request->isMethod('post'))
        {
            //валидация
            $validatedData = $request->validate([
                'name' => 'required|unique:categories|min:5|max:255'
            ]);

            try {
                $category = Category::create($validatedData);
            }catch (\Exception $e){
                return redirect()->route('admin.categories.create')->with('error', 'Ошибка добавления категории '
                    . $e->getMessage());
            }

            return redirect()->route('admin.categories.index', $category->id)->with('success','Категория успешно добавлена');
        }

        //если запрос put на редактирование
        if($request->isMethod('put'))
        {
            // Валидация данных
            $validatedData = $request->validate([
                'name' => 'required|min:5|max:255'
            ]);

            try {
                $category = Category::query()->find($request->id);
                $category->update($validatedData);
            }catch (\Exception $e){
                return redirect()->route('admin.categories.edit')->with('error', 'Ошибка обновления категории '
                    . $e->getMessage());
            }
            return redirect()->route('admin.categories.index',$category->id)->with('success','Категория успешно обновлена');
        }
        //если запрос на удаление
        if($request->isMethod('delete'))
        {
            try {
                $category = Category::query()->find($request->id);
                $category->delete();
            }catch (\Exception $e){
                return redirect()->route('admin.categories.index')->with('error', 'Ошибка удаления категории '
                    . $e->getMessage());
            }
            return redirect()->route('admin.categories.index',$category->id)->with('success','Категория успешно удалена');
        }
    }
}
