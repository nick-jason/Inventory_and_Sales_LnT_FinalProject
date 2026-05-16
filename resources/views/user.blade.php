@extends('layouts.master')

@section('user-page')
    <h1 class="text-center">Welcome to User Page</h1>
    <a href="{{ route('checkCart') }}" class="btn btn-primary btn-cart mb-3">🛒 My Cart</a>
    
    <div class="container text-start mt-5">
        @foreach ($categories as $category)
            <h4>{{ $category->name }}</h4>
            <div class="row justify-content-start">
                @foreach ($itemList as $item)
                    @if ($item->category_id == $category->id)
                        <div class="col-md-4 mb-4">
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

                                            <!-- @php
                                                $existingItem = $invoiceItems->where('item_id', $item->id)->first();
                                            @endphp
                                            <form action="{{ route('showUpdate', $item->id) }}" method="post">
                                                @csrf
                                                <div class="input-group">
                                                    @if ($existingItem)
                                                        <input type="hidden" name="invoice_id" value="{{ $existingItem->invoice_id }}">
                                                        <input type="number" class="form-control" name="quantity" placeholder="Qty" min="0" max="{{ $item->stock }}" value="{{ $existingItem->quantity }}">
                                                    @else
                                                        <input type="number" class="form-control" name="quantity" placeholder="Qty" min="0" max="{{ $item->stock }}">
                                                    @endif
                                                    <button type="submit" class="btn btn-dark btn-submit">Update cart</button>
                                                </div>
                                            </form> -->
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