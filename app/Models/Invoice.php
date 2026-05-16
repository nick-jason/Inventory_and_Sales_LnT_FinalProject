<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'invoice_number', 'address', 'postal_code','status', 'total'];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function invoiceItems(){
        return $this->hasMany(InvoiceItem::class, 'invoice_id');
    }
}
