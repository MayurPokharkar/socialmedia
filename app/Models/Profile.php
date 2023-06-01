<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Profile extends Model
{
    use HasFactory;

    protected $guarded = [];

    public $fillable = ['user_id', 'dob', 'country', 'phone', 'job_title'];

    public function profileImage()
    {
        $imagePath = ($this->image) ?  $this->image : '/profile.jpg';
        return '/storage/' . $imagePath;
    }

    ## Relation With User ##
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
