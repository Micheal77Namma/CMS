<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class post extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'title',
        'content',
        'category_id',
        'featured'
    ];

    protected $dates = ['deleted_at'];


    public function category()
    {
        return $this->belongsTo(category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(tag::class);
    }
}
