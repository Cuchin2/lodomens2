<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'last_name',
        'email',
        'password',
        'user_type_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];
    public function profile(){
        return $this->hasOne(Profile::class);
    }
    public function sales(){
        return $this->hasMany(Sale::class);
    }
    public function purchases(){
        return $this->hasMany(Purchase::class);
    }
    public function commets(){
        return $this->hasMany(Comment::class);
    }
    public function reviews(){
        return $this->hasMany(Review::class);
    }

    public function userType()
    {
        return $this->belongsTo(UserType::class);
    }
    public function socialMedia()
    {
        return $this->hasMany(SocialMediaUser::class);
    }
    /* public function shoppingCarts(){
        return $this->hasMany(ShoppingCart::class);
    } */
    public function orders(){
            return $this->hasMany(Order::class);
        }

    public function update_client($request){
        $this->update($request->all());
        $this->profile()->update([
            'dni'=>$request->dni,
            'ruc'=>$request->ruc,
            'phone'=>$request->phone,
            'description'=>$request->description,
            'birthday'=>$request->birthday
        ]);
    }
    public function getAvatarAttribute(){
        $email= md5($this->email);
        return "https://i.pravatar.cc/150?u=/$email";
    }
    public function scopeSearch($query, $value)
    {
        $query->where('name','like',"%{$value}%")
        ->orWhere('email','like',"%{$value}%")
        ->orWhereHas('roles', function ($roleQuery) use ($value) {
            $roleQuery->where('name', 'like', "%{$value}%");
        });
        /* ->orWhere('updated_at','like',"%{$value}%"); */
    }
}
