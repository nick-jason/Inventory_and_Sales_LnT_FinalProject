@extends('layouts.master')

@section('update_item')
    <div class="box">
        <h1 class="text-center">Update New Item</h1>
    
        <form action="{{ route('updateItem', $item->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="mb-3">
                <label>Input Category</label>
                <select class="form-select" name="category_id">
                    <option value="{{ $itemCategory->id }}">{{ $itemCategory->name }}</option>
                    @foreach($categoryList as $category)
                        @if($itemCategory->id == $category->id)
                            @continue
                        @endif
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>        
            </div>
            <div class="mb-3">
                <labe class="form-label">Input Item Name</label>
                <input type="text" class="form-control" name="name" value="{{ $item->name }}">
            </div>
            
            <div class="mb-3">
                <label class="form-label">Input Item Price</label>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Rp</span>
                    <input type="number" class="form-control" name="price" value="{{ $item->price }}">
                </div>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Input Item Stock</label>
                <input type="number" class="form-control" name="stock" value="{{ $item->stock }}">
            </div>
            
            <div class="mb-3">
                <label class="form-label">Input Item Image</label>
                <input type="file" class="form-control" name="image">
            </div>
    
            <button type="submit" class="btn btn-dark btn-submit">Save</button>
            <a href="/inventory" class="btn btn-outline-dark btn-outline-submit">Cancel</a>
        </form>
    </div>
@endsection