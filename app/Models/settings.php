<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class settings extends Model
{
    use HasFactory;

    protected $fillable = [
        'blog_name',
        'phone_number',
        'blog_email',
        'address'
    ];
}
