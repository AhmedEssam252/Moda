<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Favorite extends Model
{
    use HasFactory;


    public $translatable = ['title'];

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function products()
    {
      return $this->belongsToMany(Product::class);

    }
    public static function storeInFavorite(){

        $favorite = new Favorite();
        $favorite->user_id = Auth::user()->id;
        $favorite->save();
    }
}
