@extends('layouts.master')

@section('create_item')
    <div class="box">
        <h1 class="text-center">Create New Item</h1>
    
        <form action="/create" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label>Input Category</label>
                <select class="form-select" name="category_id">
                    <option selected>Choose category</option>
                    @foreach ($categoryList as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="mb-3">
                <labe class="form-label">Input Item Name</label>
                <input type="text" class="form-control" name="name" placeholder="Input item name here">
            </div>
            
            <div class="mb-3">
                <label class="form-label">Input Item Price</label>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Rp</span>
                    <input type="number" class="form-control" name="price" placeholder="Input item price here">
                </div>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Input Item Stock</label>
                <input type="number" class="form-control" name="stock" placeholder="Input item stock here">
            </div>
            
            <div class="mb-3">
                <label class="form-label">Input Item Image</label>
                <input type="file" class="form-control" name="image" placeholder="Input item image here">
            </div>
    
            <button type="submit" class="btn btn-dark btn-submit">Submit</button>
            <a href="/inventory" class="btn btn-outline-dark btn-outline-submit">Cancel</a>
        </form>
    </div>
@endsection