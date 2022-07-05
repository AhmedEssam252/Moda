<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class bag_product extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function Shoppingbag()
    {
        return $this->belongsTo(Shoppingbag::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function setTotal() {
        $this->total = $this->product->price * $this->quantity;
    }
    
    public static function storeInBag($attributes,$id){
        $bag_product = new bag_product();
        $bag_product->product_id =$attributes['product'];
        $bag_product->shoppingbag_id = $id;
        $bag_product->quantity = 1;
        $bag_product->setTotal();
        $bag_product->save();
    }
}
