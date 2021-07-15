<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::get();
        $parentCategory = Category::whereNull('parent_id')->get();
        return view('admin.categories.index', compact('categories', 'parentCategory'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>['required','max:64','min:3', 'unique:categories,name'],
        ]);
        $name = $request->name;

        $newCategory = new Category();
        $newCategory->name = $request->name;
        $newCategory->slug = Str::slug($request->name);
        if ($request->parent_id) {
            $newCategory->parent_id = $request->parent_id;
        }
        $newCategory->save();
        return back()->with('success', 'Tambah Kategori Berhasil!');
    }
}
