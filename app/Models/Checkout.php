<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Checkout extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $casts = [
        'productsInfo' => 'object',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeFilter($query, array $filters){
        $query->when($filters['search'] ?? false,fn($query, $search) =>
            $query
            ->where('id','like', '%' . $search . '%')
            ->orWhere('status', 'like', '%' . $search . '%')
            ->orWhere('created_at', 'like', '%' . $search . '%')
    );

    }

    public static function create($attributes){
        $checkout = new Checkout();
        $checkout->user_id = Auth::user()->id;
        $checkout->Address = $attributes['Address'];
        $checkout->Apartment_number = $attributes['Apartment_number'];
        $checkout->City = $attributes['City'];
        $checkout->State = $attributes['State'];
        $checkout->Postal_Code = $attributes['Postal_Code'];
        $checkout->Country = $attributes['Country'];
        $checkout->Payment_method = $attributes['Cash_On_Delivery'];
        $checkout->status = 'In review';
        $checkout->productsInfo = Product::join('bag_products','products.id','=','bag_products.product_id')
        ->join('shoppingbags','shoppingbags.id','=','bag_products.shoppingbag_id')
        ->join('users','users.id','=','shoppingbags.user_id')
        ->where('shoppingbags.user_id',Auth::user()->id)->get();
        $checkout->Total = bag_product::join('shoppingbags','shoppingbags.id','=','bag_products.shoppingbag_id')
        ->where('shoppingbags.user_id',Auth::user()->id)->sum('total');
        $checkout->save();
    }

    public static function updateThing($attributes,$customerRequest){
        Checkout::where('id',$customerRequest->id)->update([
            'status' => $attributes['status'],
        ]);
    }


}
