<?php

namespace App\Listeners;

use App\Events\StoreCreated;
use DirectoryIterator;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class CreateStoreDatabase
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(StoreCreated $event): void
    {
        $store = $event->store;

        $db = "tenancy_orginaztion_{$store->id}";

        $store->database_option = [
            'dbname' => $db,
        ];
        $store->save();

        // $old_db = Config::get('database.connections.mysql.database');


        DB::statement("CREATE DATABASE `{$db}`"); 

        Config::set('database.connections.tenant.database',$db);

        $dir = new DirectoryIterator(database_path('migrations/orginzations'));
        foreach($dir as $file){
            if($file->isFile()){
                Artisan::call('migrate',[
                    '--database' => "tenant",
                    '--path' => 'database/migrations/orginzations/'. $file->getFilename(),
                    '--force' => true,
        
                ]);
            }
        }
        

        // Config::set('database.connections.mysql.database',$old_db);

    }
}
