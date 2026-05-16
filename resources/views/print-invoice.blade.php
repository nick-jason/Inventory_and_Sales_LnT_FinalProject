@extends('layouts.master')

@section('print-invoice')
    <h1 class="text-center">Order ID : {{ $invoice->id }}</h1>

    <div class="container mt-4" style="width: 60%;">
        <div class="card justify-content-center">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h6 style="font-weight: normal; margin: 0;">
                        Status : 
                        <span style="color: green;">{{ $invoice->status }}</span>
                    </h6>
                    <h6 style="font-weight: normal; margin: 0; opacity: 50%;">{{ $invoice->updated_at }}</h6>
                </div>
            </div>
            <div class="card-body">
                <div class="card-text">
                    <h4>
                        Invoice Number : 
                        <span style="font-weight: normal;">
                            {{ $invoice->invoice_number }}
                        </span>
                    </h4>
                    <br>
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6>Ordered Items :</h6>
                            @foreach ($invoice->invoiceItems as $invoiceItem)
                                <h6 style="font-weight: normal;">( {{ $invoiceItem->quantity }}x ) {{ $invoiceItem->item->name }} | {{ $invoiceItem->item->category->name }}</h6>
                            @endforeach
                        </div>
                        <div class="text-end">
                            <h6>Subtotal :</h6>
                            @foreach ($invoice->invoiceItems as $invoiceItem)
                                <h6 style="font-weight: normal;">Rp.{{ number_format($invoiceItem->subtotal, 0, '.', ',') }}</h6>
                            @endforeach
                        </div>
                    </div>
                    <br>
                    <h5 class="text-center">
                        Total : Rp.{{ number_format($invoice->total, 0, '.', ',') }}
                    </h5>
                    <br>
                    <h6>
                        Address : 
                        <span style="font-weight: normal;">
                            {{ $invoice->address }}
                        </span>
                    </h6>
                    <h6>
                        Postal Code : 
                        <span style="font-weight: normal;">
                            {{ $invoice->postal_code }}
                        </span>
                    </h6>
                </div>
            </div>
        </div>
    </div>
@endsection