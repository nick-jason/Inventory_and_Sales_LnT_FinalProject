@extends('layouts.master')

@section('inventory')
    <h1 class="text-center">Inventory</h1>

    <div class="d-grid d-md-flex gap-2 mt-4 justify-content-md-end">
        <a href="/create-item" class="btn btn-primary mb-3">+ Add New Item</a>
    </div>

    <div class="container text-start mt-5">
        @foreach ($categories as $category)
            <h4>{{ $category->name }}</h4>
            <div class="row justify-content-start mb-4">
                @foreach ($itemList as $item)
                    @if ($item->category_id == $category->id)
                        <div class="col-md-4">
                            <div class="card" style="max-width: 540px;">
                                <div class="row g-0">
                                    <div class="col-md-4">
                                        @if ($item->image)
                                            <img style="align-self: center;" src="{{ asset('storage/images/' . $item->image) }}" class="img-fluid rounded-start" alt="{{ $item->name }} Image">
                                        @else
                                            <img style="align-self: center;" src="{{ asset('storage/images/no_image_found.png') }}" class="img-fluid rounded-start" alt="No Image">    
                                        @endif
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $item->name }}</h5>
                                            <h6 class="card-text">Rp.{{ number_format($item->price, 0, '.', ',') }}</h6>
                                            <h6 class="card-text">
                                                Stock : 
                                                @if ($item->stock > 0)
                                                    {{ $item->stock }}
                                                @else
                                                    <span style="font-style: italic; font-weight: normal; color: red;">Sold Out</span>    
                                                @endif
                                            </h6>
                                            <p class="card-text" style="font-style: italic;">Category : {{ $item->category->name }}</p>
                
                                            <div class="d-grid d-md-flex gap-2 mt-2 justify-content-md-start">
                                                <a href="{{ route('showUpdate', $item->id) }}" class="btn btn-primary">Edit</a>
                                                <form action="{{ route('deleteItem', $item->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger">Delete</button>
                                                </form>        
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        @endforeach
    </div>
@endsection