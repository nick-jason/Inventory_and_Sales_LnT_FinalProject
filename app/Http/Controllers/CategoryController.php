<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function showCategory(){
        $categoryList = Category::all();
        return view('category', compact('categoryList'));
    }

    public function createCategory(Request $req){
        $req->validate([
            'name' => 'required|string|min:5|max:80',
        ]);

        Category::create([
            'name' => $req->name
        ]);

        return redirect('/categories');
    }

    public function deleteCategory($id){
       $category = Category::findOrFail($id);
       $category->delete();
       return redirect('/categories');
    }
}