@extends('layouts.master')

@section('view_category')
    <div class="mx-5">
        <h1 class="text-center">Category List</h1>
    
        <form action="/create-category" method="post">
            @csrf
            <div class="mb-3">
                <label>Input Category</label>
                <input type="text" class="form-control mb-3" name="name" placeholder="Input item category here">
                <button type="submit" class="btn btn-primary mb-5">+ Add Category</button>
            </div>
        </form>
    
        <div class="table-responsive">
            <table class="table table-striped align-middle">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Category</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @foreach ($categoryList as $category)
                        <tr>
                            <th scope="row" class="align-middle">{{ $category->id }}</th>
                            <td class="align-middle">{{ $category->name }}</td>
                            <td class="d-grid d-md-flex gap-2 justify-content-md-start">
                                <form action="{{ route('deleteItem', $category->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection