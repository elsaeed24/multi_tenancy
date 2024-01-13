<?php


namespace App\Traits;

use App\Models\Store;
use Illuminate\Support\Facades\App;

trait GlobalStore
{
    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public static function bootGlobalStore()
    {
        static::addGlobalScope('store', function($query){
            $store = App::make('storeActive');
            $query->where('store_id',$store->id);

        });
    }


}