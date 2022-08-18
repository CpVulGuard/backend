<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'reason',
        'soPostId',
        'user_id',
        'codeBlockIndex',
        'rows',
        'type',
        'realTime'
    ];

    /**
     * Get the User of the UserRequest
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected static function booted()
    {
        static::created(function ($userRequest) {
            app('App\Http\Controllers\UserController')->addRequest($userRequest->user_id);
        });
    }
}
