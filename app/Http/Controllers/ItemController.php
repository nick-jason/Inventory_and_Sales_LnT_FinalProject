<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\InvoiceItem;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    // User
    public function userPage(){
        $categories = Category::all();
        $itemList = Item::all();
        $invoiceItems = InvoiceItem::all();
        return view('user', compact('categories', 'itemList', 'invoiceItems'));
    }

    // Admin
    public function adminPage(){
        $categories = Category::all();
        $itemList = Item::all();
        return view('inventory', compact('categories', 'itemList'));
    }

    public function showCreate(){
        $categoryList = Category::all();
        return view('create', compact('categoryList'));
    }

    public function createItem(Request $request){
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|min:5|max:80',
            'price' => 'required|integer|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = null;
        if($request->hasFile('image')){
            $now = now()->format('Y-mpd_H.i.s');
            $imagePath = $now . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAS('images', $imagePath, 'public');
        }

        Item::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'image' => $imagePath,
        ]);

        return redirect()->route('adminPage');
    }

    public function showUpdate($id){
        $item = Item::findOrFail($id);
        $itemCategory = Category::findOrFail($item->category_id);
        $categoryList = Category::all();
        return view('update', compact('item', 'itemCategory', 'categoryList'));
    }

    public function updateItem(Request $request, $id){
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|min:5',
            'price' => 'required|integer|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $item = Item::findOrFail($id);
        $item->category_id = $request->category_id;
        $item->name = $request->name;
        $item->price = $request->price;
        $item->stock = $request->stock;
        if($request->hasFile('image')){
            if($item->image){
                $imagePath = $item->image;
                Storage::disk('public')->delete('images/' . $item->image);
            }
            $now = now()->format('Y-mpd_H.i.s');
            $imagePath = $now . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAS('images', $imagePath, 'public');
        } 
        else{
            $imagePath = $item->image;
        }
        $item->image = $imagePath;

        $item->save();
        return redirect()->route('adminPage');
    }

    public function deleteItem($id){
        $item = Item::findOrFail($id);

        if($item->image){
            Storage::disk('public')->delete('images/' . $item->image);
        }
        $item->delete();

        return redirect()->route('adminPage');
    }
}