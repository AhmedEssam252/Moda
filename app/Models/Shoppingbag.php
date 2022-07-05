<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Shoppingbag extends Model
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
    public static function storeInBag(){
        foreach(Shoppingbag::all() as $shoppingbag){
            if($shoppingbag->user_id == Auth::user()->id){
                return $shoppingbag->id;
            }
        }
        try{
        $shoppingbag = new Shoppingbag();
        $shoppingbag->user_id = Auth::user()->id;
        $shoppingbag->save();
        return $shoppingbag->id;
        }catch(\Exception $e){
            return redirect()->back()->with('errorRemoveFromBag', __('lang.SomethingWentWrong'));
        }
}

}
