<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use SoftDeletes;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function is_online()
    {
        return Cache::has('user-is-online' . $this->id);
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
        $admin = new Admin();
        $admin->first_name = $attributes['FirstName'];
        $admin->last_name = $attributes['LastName'];
        $admin->email = $attributes['Email'];
        $admin->password = bcrypt($attributes['Password']);
        $admin->save();
    }
    public static function updateCategory($admin,$attributes){

        $admin->first_name = $attributes['FirstName'];
        $admin->last_name = $attributes['LastName'];
        $admin->email = $attributes['Email'];
        $admin->password = bcrypt($attributes['Password']);
        $admin->update();
    }
}
