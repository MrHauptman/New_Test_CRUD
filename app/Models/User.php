<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;
use App\Models\Role;
use App\Models\Product;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'balance',
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
        'password' => 'hashed',
    ];
   //// protected $appends = ['role_id'];
    ///public function getRoleIdAttribute(){
     ///   return $this->attributes['role_id'];
    //}
    public function role(){
        return $this->belongsTo(Role::class);
    }
    public function product(){
        return $this->hasMany(Product::class);
    }
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($user) {
            $user->slug = Str::slug($user->name);  // Generate slug from the user’s name
        });
    }
}
