@extends('layouts.master')

@section('invoice')
    <h1 class="text-center">My Cart</h1>

    <div class="box mt-3">
        <form action="{{ route('createInvoiceItem') }}" method="post">
            @csrf
            <div class="mb-3">
                <input type="hidden" name="invoice_id" value="{{ $invoice_id }}">
                <label>Input Item</label>
                <select class="form-select" name="item_id">
                    <option selected>Choose item</option>
                    @foreach ($itemList as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label>Quantity</label>
                <input type="text" class="form-control mb-3" name="quantity" placeholder="Input item quantity here">
                <p style="font-style: italic; font-size: small; color: rgba(0, 0, 0, 0.40);">Note : Decrease quantity by inputing negative number (example: -5)</p>
                <button type="submit" class="btn btn-primary">+ Add to cart</button>
            </div>
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
        </form>
    </div>

    <form action="{{ route('submitInvoice', $invoice_id) }}" method="post">
        @csrf
        @method('PATCH')
        <input type="hidden" name="total" value="{{ $total }}">
        <h5 style="text-align: center;" class="mt-5">Total : Rp.{{ number_format($total, 0, '.', ',') }}</h5>
        <div class="align-middle d-grid d-md-flex gap-2 justify-content-md-center">
            <button type="submit" class="btn btn-dark btn-submit">Submit Order</button>
        </div>
    </form>

    <table class="mt-4 table table-striped">
        <thead>
            <tr>
                <th class="align-middle" scope="col">#</th>
                <th class="align-middle" scope="col">Item ID</th>
                <th class="align-middle" scope="col">Item Name</th>
                <th class="align-middle" scope="col">Quantity</th>
                <th class="align-middle" scope="col">Price (Rp.)</th>
                <th class="align-middle" scope="col">Subtotal (Rp.)</th>
                <th class="align-middle" scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($invoiceItems as $invoice)
                <tr>
                    <th class="align-middle" scope="row">{{ $loop->iteration }}</th>
                    <td class="align-middle">{{ $invoice->item_id }}</td>
                    <td class="align-middle">{{ $invoice->item->name }}</td>
                    <td class="align-middle">{{ $invoice->quantity }}</td>
                    <td class="align-middle">{{ number_format($invoice->price, 0, '.', ',') }}</td>
                    <td class="align-middle">{{ number_format($invoice->subtotal, 0, '.', ',') }}</td>
                    <td class="align-middle d-grid d-md-flex gap-2 justify-content-md-start">
                        <form action="{{ route('deleteInvoiceItem', $invoice->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection