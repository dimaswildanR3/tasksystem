<?php

namespace App\Http\Controllers;

// app/Http/Controllers/CategoryController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoryTask;


class CategoryController extends Controller
{
    public function index()
    {
        $categories = CategoryTask::all();
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255|unique:category_tasks',
        ]);

        CategoryTask::create([
            'name' => $request->input('name'),
        ]);

        return redirect()->route('categories.index')->with('success', 'Category Created Successfully');
    }public function edit(CategoryTask $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, CategoryTask $category)
    {
        $request->validate([
            'name' => 'required|max:255|unique:category_tasks,name,' . $category->id,
        ]);

        $category->update([
            'name' => $request->input('name'),
        ]);

        return redirect()->route('categories.index')->with('success', 'Category Updated Successfully');
    }

    public function destroy(CategoryTask $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category Deleted Successfully');
    }
}
