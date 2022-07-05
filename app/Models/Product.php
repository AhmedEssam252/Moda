<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    use HasTranslations;
    use SoftDeletes;

    public $translatable = ['title','description','recovery'];

    protected $guarded = [];
    protected $casts = [
        'size' => 'array'
    ];

    public function subcategory(){
        return $this->belongsTo(Subcategory::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function shoppingbag(){
        return $this->belongsToMany(Shoppingbag::class);
    }

    public function favorite(){
        return $this->belongsToMany(Favorite::class);
    }
        //get search
    public function scopeFilter($query, array $filters){
        $query->when($filters['search'] ?? false,fn($query, $search) =>
            $query
            ->where('id','like', '%' . $search . '%')
            ->orWhere('title->ar', 'like', '%' . $search . '%')
            ->orWhere('title->en', 'like', '%' . $search . '%')
            ->orWhere('route', 'like', '%' . $search . '%'));

        // filter by price
        $query->when($filters['minmum'] ?? false,fn($query) =>
            $query->
            where('price','>=',$filters['minmum'])
            ->where('price','<=',$filters['maximum'])
        );
        $query->when($filters['maximum'] ?? false,fn($query) =>
            $query->
            where('price','>=',$filters['minmum'])
            ->where('price','<=',$filters['maximum'])
        );
        //filter with size
        $query->when($filters['size'] ?? false,fn($query) =>
            $query->
            whereJsonContains('size', $filters['size'])
        );
        // filter by subcategory
        $query->when($filters['subcategory'] ?? false, fn($query, $subcategory) =>
        $query
            ->whereExists(fn($query) =>
                $query->from('subcategories')
                ->whereColumn('subcategories.id','products.subcategory_id')
                ->where('subcategories.route',$subcategory)));
        // filter by category
        $query->when($filters['category'] ?? false, fn($query, $category) =>
        $query
            ->whereExists(fn($query) =>
                $query->from('categories')
                ->whereColumn('categories.id','products.category_id')
                ->where('categories.route',$category)));
    }
    public static function create($attributes)
    {
        // validate
        $product = new Product();
        $product->category_id = $attributes['categoryName'];
        $product->subcategory_id = $attributes['SubCategoryName'];
        $product->title = ['ar' => $attributes['ArabicName'] , 'en' => $attributes['EnglishName']];
        $product->description = ['ar' => $attributes['ArabicDescription'] , 'en' => $attributes['EnglishDescription']];
        $product->price = $attributes['price'];
        $product->size = $attributes['size'];
        $product->recovery =  ['ar' => $attributes['ArabicRecovery'] , 'en' => $attributes['EnglishRecovery']];
        $product->route = $attributes['route'];
        $file = array();
        $Newfiles = array();
            if($file = request()->hasFile('upload_image')){
                foreach (request()->file('upload_image') as $file) {
                    $fileName = md5(rand(100,1000)) . time() . '.' . strtolower($file->getClientOriginalExtension());
                    $folderName = "Product/" . request()->EnglishName ;
                    $fullUrl = $folderName . '/' . $fileName;
                    $file->storeAs($folderName, $fileName , 'public');
                    $Newfiles[] = $fullUrl;
                }
            }
        $image = implode('|' , $Newfiles);
        $product->image = $image;
        $product->save();
    }
    public static function updateCategory($product,$attributes){

        $product->title = ['ar' => $attributes['ArabicName'], 'en' => $attributes['EnglishName']];
        $product->category_id = $attributes['categoryName'];
        $product->subcategory_id = $attributes['SubCategoryName'];
        $product->route = $attributes['route'];
        $product->description = ['ar' => $attributes['ArabicDescription'] , 'en' => $attributes['EnglishDescription']];
        $product->price = $attributes['price'];
        $product->size = $attributes['size'];
        $product->recovery =  ['ar' => $attributes['ArabicRecovery'] , 'en' => $attributes['EnglishRecovery']];

        $file = array();
        $Newfiles = array();
        if($file = request()->hasFile('upload_image')){
            $imageArray = explode('|',$product->image);
            foreach ($imageArray as $image) {
                Storage::disk('public')->delete($image);
            }
            foreach (request()->file('upload_image') as $file) {
                $fileName = md5(rand(100,1000)) . time() . '.' . strtolower($file->getClientOriginalExtension());
                $folderName = "Product/" . request()->EnglishName;
                $fullUrl = $folderName . '/' . $fileName;
                $file->storeAs($folderName, $fileName , 'public');
                $Newfiles[] = $fullUrl;
            }
            $image = implode('|' , $Newfiles);
            $product->image = $image;
        }

        $product->update();
    }
}
