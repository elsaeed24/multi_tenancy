<?php

namespace App\Http\Middleware;

use App\Models\Store;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Symfony\Component\HttpFoundation\Response;

class SetActiveStore
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // get store active now from domain
        $host = $request->getHost(); // fetch host now
        $store = Store::where('domain',$host)->firstOrFail();

        // store this store in service container 

        App::instance('storeActive',$store);

        $db = $store->database_option['dbname'];
        Config::set('database.connections.tenant.database',$db);
        

        return $next($request);
    }
}
