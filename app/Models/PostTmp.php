<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostTmp extends Model
{
    use HasFactory;

    protected $fillable = [
        'reason',
        'soPostId',
        'imported',
        'codeBlockIndex',
        'rows'
    ];
}
