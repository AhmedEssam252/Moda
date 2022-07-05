<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Cache;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
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
        'last_seen',
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

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function is_online()
    {
        return Cache::has('user-is-online' . $this->id);
    }

    public function favorites()
    {
        return $this->hasOne(Favorite::class);
    }
    public function shoppingbags()
    {
        return $this->hasOne(Shoppingbag::class);
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
        $user = new User();
        $user->first_name = $attributes['FirstName'];
        $user->last_name = $attributes['LastName'];
        $user->email = $attributes['Email'];
        $user->password = bcrypt($attributes['Password']);
        $user->save();
    }
    public static function updateCategory($user,$attributes){

        $user->first_name = $attributes['FirstName'];
        $user->last_name = $attributes['LastName'];
        $user->email = $attributes['Email'];
        $user->update();
    }
}

