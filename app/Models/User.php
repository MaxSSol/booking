<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'birth_date',
        'sex',
        'country',
        'city',
        'image',
        'tel_num'
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

    public function roles(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    public function paymentMethods(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(PaymentMethod::class);
    }

    public function accommodation(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Accommodation::class);
    }

    public function rentInfo(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(RentInfo::class);
    }

    public function rentHistories(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(RentHistory::class);
    }

    public function accommodationComments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(AccommodationComment::class);
    }
}
