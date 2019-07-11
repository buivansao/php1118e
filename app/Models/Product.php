<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Brand;
class Product extends Model
{
    protected $table = 'products';
    protected $guarded = [];
    public $fillable = [
        'name',
        'slug',
        'image',
        'description',
        'brand_id',
        'stock_price',
        'price',
        'content',
        'created_at',
        'updated_at',
        'stock',
        'status',
    ];
    public function brand()
    {
    	return $this->belongsTo('App\Models\Brand', 'brand_id');
    }
}
