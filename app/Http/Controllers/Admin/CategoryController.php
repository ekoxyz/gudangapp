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
        $newCategory = new Category();
        $newCategory->name = $request->name;
        $newCategory->slug = Str::slug($request->name);
        if ($request->parent_id) {
            $newCategory->parent_id = $request->parent_id;
        }
        $newCategory->save();
        return back()->with('success', 'Tambah Kategori Berhasil!');
    }

    public function update(Request $request, Category $category)
    {

        /**
         * TODO
         * request data categories baru yang akan di jadikan parent, adalah yang bukan menjadi children nya.
         *
         */
        $request->validate([
            'name_edit'=>['required','max:64','min:3', 'unique:categories,name'],
        ]);
        $category->name = $request->name_edit;
        $category->slug = Str::slug($request->name_edit);
        if ($request->parent_id_edit) {
            $category->parent_id = $request->parent_id_edit;
        }
        return $category;
    }
    public function destroy(Category $category)
    {
        return $category;
    }
}
