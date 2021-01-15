<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('category/categories')->with('categories', $categories);
    }

    public function create()
    {
        return view('category/create_category');
    }

    public function save(SaveCategoryRequest $request)
    {
        $category = new Category($request->all());
        $category->save();
        return redirect()->back();
    }

    public function edit(Category $category)
    {
        return view('category/edit_category')->with('category', $category);
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->update($request->all());
        return redirect()->route('categories.all');
    }

    public function delete(Category $category)
    {
        $category->delete();
        return redirect()->back();
    }
}
