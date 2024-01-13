<?php

namespace App\Models;

use App\Traits\GlobalStore;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory,GlobalStore;

    
    protected $guarded =[];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

}
