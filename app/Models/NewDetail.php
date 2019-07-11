<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewDetail extends Model
{
    protected $table = 'news';
    public $fillable = [
        'name',
        'image',
        'content',
        'description',
        'content',
        'status',
    ];
}
