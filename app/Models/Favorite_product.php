<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Favorite_product extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function favorite()
    {
        return $this->belongsTo(Favorite::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public static function storeInFavorite($attributes){
        $favorite_product = new Favorite_product();
        $favorite_product->product_id =$attributes['product'];
        $favorite_product->favorite_id = Favorite::where('user_id',Auth::user()->id)->first()->id;
        $favorite_product->save();
    }
}
