<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use HasTranslations;
    use SoftDeletes;

    public $translatable = ['title'];

    protected $guarded = [];

    public function subcategory(){
        return $this->hasMany(Subcategory::class);
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
    }

    public static function create($attributes)
    {
        // validate
        $category = new Category();
        $category->title = ['ar' => $attributes['ArabicName'] , 'en' => $attributes['EnglishName']];
        $category->route = $attributes['route'];
        $file = array();
        $Newfiles = array();
            if($file = request()->hasFile('upload_image')){
                foreach (request()->file('upload_image') as $file) {
                    $fileName = md5(rand(100,1000)) . time() . '.' . strtolower($file->getClientOriginalExtension());
                    $folderName = "categories/" . request()->EnglishName ;
                    $fullUrl = $folderName . '/' . $fileName;
                    $file->storeAs($folderName, $fileName , 'public');
                    $Newfiles[] = $fullUrl;
                }
            }
        $image = implode('|' , $Newfiles);
        $category->image = $image;
        $category->save();
    }
    public static function updateCategory($category,$attributes){
        $file = array();
        $Newfiles = array();
        if($file = request()->hasFile('upload_image')){
            $imageArray = explode('|',$category->image);
            foreach ($imageArray as $image) {
                Storage::disk('public')->delete($image);
            }
            foreach (request()->file('upload_image') as $file) {
                $fileName = md5(rand(100,1000)) . time() . '.' . strtolower($file->getClientOriginalExtension());
                $folderName = "categories/" . request()->EnglishName;
                $fullUrl = $folderName . '/' . $fileName;
                $file->storeAs($folderName, $fileName , 'public');
                $Newfiles[] = $fullUrl;
            }
            $image = implode('|' , $Newfiles);
            $category->image = $image;
        }
        $category->title = ['ar' => $attributes['ArabicName'], 'en' => $attributes['EnglishName']];
        $category->route = $attributes['route'];
        $category->update();
    }

}




