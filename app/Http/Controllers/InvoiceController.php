<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\InvoiceItem;
use App\Models\Item;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InvoiceController extends Controller
{
    public function showInvoice($invoice_id){
        $invoiceItems = InvoiceItem::where('invoice_id', $invoice_id)->get();
        $itemList = Item::all();

        $total = 0;
        foreach ($invoiceItems as $invoice) {
            $total = $total + $invoice->subtotal;
        }

        return view('invoice', compact('total','invoice_id','invoiceItems', 'itemList'));
    }

    public function checkCart(){
        $user = auth()->user();

        if(empty($user->address) || empty($user->postal_code)){
            return redirect('/profile')->with('error', 'Please fill in your address and postal code first!');
        }

        $invoice = Invoice::where('user_id', $user->id)->where('status', 'pending')->first();
        $invoiceNumber = date('Ymd') . str_pad(Invoice::count() + 1, 4, '0', STR_PAD_LEFT) . random_int(10000, 99999);
        $total = 0;

        if(!$invoice){
            $invoice = Invoice::create([
                'user_id' => $user->id,
                'invoice_number' => $invoiceNumber,
                'address' => $user->address,
                'postal_code' => $user->postal_code,
                'total' => $total,
            ]);
        }

        return redirect()->route('showInvoice', $invoice->id);
    }

    public function createInvoiceItem(Request $req){
        $req->validate([
            'invoice_id' => 'required|exists:invoices,id',
            'item_id' => 'required|exists:items,id',
            'quantity' => 'required|integer',
        ]);
        
        $invoiceItem = InvoiceItem::where('invoice_id', $req->invoice_id)->where('item_id', $req->item_id)->first();
        if($invoiceItem){
            // return redirect()->route('updateInvoiceItem', $req->id);
            return $this->updateInvoiceItem($req, $invoiceItem->id);
        }

        $item = Item::findOrFail($req->item_id);
    
        if($req->quantity > $item->stock){
            return redirect()->back()->with('error', 'Requested item quantity is more than stock!');
        }

        $subtotal = $item->price * $req->quantity;

        InvoiceItem::create([
            'invoice_id' => $req->invoice_id,
            'item_id' => $req->item_id,
            'quantity' => $req->quantity,
            'price' => $item->price,
            'subtotal' => $subtotal,
        ]);

        return redirect()->route('checkCart');
    }

    public function submitInvoice(Request $req, $id){
        $req->validate([
            'total' => 'required',
        ]);

        $user = auth()->user();
        $invoice = Invoice::findOrFail($id);
        $invoiceNum = $invoice->invoice_number;

        $invoice->user_id = $user->id;
        $invoice->invoice_number = $invoiceNum;
        $invoice->address = $user->address;
        $invoice->postal_code = $user->postal_code;
        $invoice->status = 'complete';
        $invoice->total = $req->total;

        $invoice->save();

        $invoiceItems = InvoiceItem::where('invoice_id', $id)->with('item')->get();
        foreach($invoiceItems as $invoiceItem){
            $invoiceItem->item->stock -= $invoiceItem->quantity;
            $invoiceItem->item->save();
        }

        return redirect()->route('showHistory');
    }
    
    public function updateInvoiceItem(Request $req, $id){
        $invoiceItem = InvoiceItem::findOrFail($id);
        $item = Item::where('id', $invoiceItem->item_id)->first();
    
        $orderQuantity = $invoiceItem->quantity + $req->quantity;
        $currStock = $item->stock - $orderQuantity;

        if($req->quantity > $currStock){
            return redirect()->back()->with('error', 'Requested item quantity is more than avaiable stock!');
        }

        $subtotal = $invoiceItem->price * $orderQuantity;

        $invoiceItem->invoice_id = $req->invoice_id;
        $invoiceItem->item_id = $req->item_id;
        $invoiceItem->quantity = $orderQuantity;
        $invoiceItem->price = $item->price;
        $invoiceItem->subtotal = $subtotal;

        $invoiceItem->save();
            
        return redirect()->route('checkCart');
    }

    public function updateInvoiceItemHome(Request $req, $id){
        $invoiceItem = InvoiceItem::findOrFail($id);
        $item = Item::where('id', $invoiceItem->item_id)->first();
    
        $orderQuantity = $invoiceItem->quantity + $req->quantity;
        $currStock = $item->stock - $orderQuantity;

        if($req->quantity > $currStock){
            return redirect()->back()->with('error', 'Requested item quantity is more than avaiable stock!');
        }

        $subtotal = $invoiceItem->price * $orderQuantity;

        $invoiceItem->invoice_id = $req->invoice_id;
        $invoiceItem->item_id = $req->item_id;
        $invoiceItem->quantity = $orderQuantity;
        $invoiceItem->price = $item->price;
        $invoiceItem->subtotal = $subtotal;

        $invoiceItem->save();
            
        return redirect()->route('checkCart');
    }

    public function deleteInvoiceItem($id){
        $invoiceItem = InvoiceItem::findOrFail($id);
        $invoiceItem->delete();
        return redirect()->route('checkCart');
    }
    public function showHistory(){
        $invoices = Invoice::with('invoiceItems.item.category')->latest()->get();
        return view('userHistory', compact('invoices'));
    }
    public function showPrintInvoice($id){
        $invoice = Invoice::where('id', $id)->with('invoiceItems.item.category')->first();
        return view('print-invoice', compact('invoice'));
    }
}