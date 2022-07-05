<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subcategory extends Model
{
    use HasFactory;
    use HasTranslations;
    use SoftDeletes;

    public $translatable = ['title'];

    protected $guarded = [];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function product(){
        return $this->hasMany(Product::class);
    }

    public function scopeFilter($query, array $filters){
        $query->when($filters['search'] ?? false,fn($query, $search) =>
            $query
            ->where('id','like', '%' . $search . '%')
            ->orWhere('title->ar', 'like', '%' . $search . '%')
            ->orWhere('title->en', 'like', '%' . $search . '%')
            ->orWhere('route', 'like', '%' . $search . '%'));

        $query->when($filters['category'] ?? false, fn($query, $category) =>
            $query
                ->whereExists(fn($query) =>
                    $query->from('categories')
                    ->whereColumn('categories.id','subcategories.category_id')
                    ->where('categories.route',$category))
        );
    }

    public static function create($attributes)
    {
        // validate
        $subcategory = new Subcategory();
        $subcategory->category_id = $attributes['categoryName'];
        $subcategory->title = ['ar' => $attributes['ArabicName'] , 'en' => $attributes['EnglishName']];
        $subcategory->route = $attributes['route'];
        $file = array();
        $Newfiles = array();
            if($file = request()->hasFile('upload_image')){
                foreach (request()->file('upload_image') as $file) {
                    $fileName = md5(rand(100,1000)) . time() . '.' . strtolower($file->getClientOriginalExtension());
                    $folderName = "SubCategories/" . request()->EnglishName ;
                    $fullUrl = $folderName . '/' . $fileName;
                    $file->storeAs($folderName, $fileName , 'public');
                    $Newfiles[] = $fullUrl;
                }
            }
        $image = implode('|' , $Newfiles);
        $subcategory->image = $image;
        $subcategory->save();
    }
    public static function updateCategory($subcategory,$attributes){
        $file = array();
        $Newfiles = array();
        if($file = request()->hasFile('upload_image')){
            $imageArray = explode('|',$subcategory->image);
            foreach ($imageArray as $image) {
                Storage::disk('public')->delete($image);
            }
            foreach (request()->file('upload_image') as $file) {
                $fileName = md5(rand(100,1000)) . time() . '.' . strtolower($file->getClientOriginalExtension());
                $folderName = "SubCategories/" . request()->EnglishName;
                $fullUrl = $folderName . '/' . $fileName;
                $file->storeAs($folderName, $fileName , 'public');
                $Newfiles[] = $fullUrl;
            }
            $image = implode('|' , $Newfiles);
            $subcategory->image = $image;
        }
        $subcategory->category_id = $attributes['categoryName'];
        $subcategory->title = ['ar' => $attributes['ArabicName'], 'en' => $attributes['EnglishName']];
        $subcategory->route = $attributes['route'];
        $subcategory->update();
    }
}
