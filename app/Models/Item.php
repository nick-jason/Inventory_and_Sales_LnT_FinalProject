<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Item extends Model
{
    use HasFactory;
        protected $fillable = ['category_id','name', 'price', 'stock', 'image'];

    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function invoiceItems(){
        return $this->hasMany(InvoiceItem::class, 'item_id');
    }
}
