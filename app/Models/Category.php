<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = [
        'name',
        'slug',
        'description',
        'parent_id',
        'content',
        'position',
        'meta_title',
        'meta_description',
        'meta_keyword',
        'created_at',
        'updated_at',
        'status',
    ];
}
