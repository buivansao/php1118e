<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
class Brand extends Model
{
    protected $table = 'brands';
    public $fillable = [
        'name',
        'slug',
        'logo',
        'description',
        'status',
    ];
    public $timestamps = false;
    public function product()
    {
    	return $this->hasMany('App\Models\Product', 'brand_id');
    }
}
