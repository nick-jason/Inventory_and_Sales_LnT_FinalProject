@extends('layouts.master')

@section('user-history')
    <h1 class="text-center">Order History</h1>
    <a href="{{ route('checkCart') }}" class="btn btn-primary btn-cart mb-3">🛒 My Cart</a>

    <div class="container text-start mt-5">
        <div class="row justify-content-center">
            @foreach ($invoices as $invoice)
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between">
                                <h6 style="font-weight: normal; margin: 0;">
                                    Status : 
                                    @if ($invoice->status == 'complete')
                                        <span style="color: green;">{{ $invoice->status }}</span>
                                    @elseif ($invoice->status == 'pending')
                                        <span style="color: orange;">{{ $invoice->status }}</span>
                                    @endif
                                </h6>
                                <h6 style="font-weight: normal; margin: 0; opacity: 50%;">{{ $invoice->updated_at }}</h6>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-2">
                                <h4 class="card-title">Order ID : {{ $invoice->id }}</h4>
                                @if ($invoice->status == 'complete')
                                    <a href="{{ route('showPrintInvoice', $invoice->id) }}" class="btn btn-dark btn-submit">Print</a>
                                @endif
                            </div>
                            <div class="card-text">
                                @foreach ($invoice->invoiceItems as $invoiceItem)
                                    <h6 style="font-weight: normal;">( {{ $invoiceItem->quantity }}x ) {{ $invoiceItem->item->name }}</h6>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection