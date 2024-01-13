<?php

namespace App\Models;

use App\Traits\GlobalStore;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded =[];

    protected $connection = "tenant";

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}
