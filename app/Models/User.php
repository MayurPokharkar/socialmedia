<?php

namespace App\Models;

use App\Models\Post;
use App\Models\Likes;
use App\Models\Profile;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $guarded = [];

    protected $fillable = [
        'name',
        'email',
        'dob',
        'phone',
        'country',
        'password',
        'brief',
        'job_title',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // protected static function boot()
    // {
    //     parent::boot();

    //     static::created(function ($user) {
    //         $user->profile()->create([
    //             'title' => $user->username,
    //         ]);

    //         // Mail::to($user->email)->send(new NewUserWelcomeMail());
    //     });
    // }

    public function likes()
    {
        return $this->hasMany(Likes::class);
    }

    ### Relation With User's Profile ###
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function posts()
    {
        return $this->hasMany(Likes::class);
    }
}
