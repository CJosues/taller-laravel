<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class IdentifyTenant
{
    public function handle($request, Closure $next)
    {
        $host = $request->getHost();
        $subdomain = explode('.', $host)[0] ?? null;

        $map = config('tenants.map');
        $db = config('tenants.default');

        if ($subdomain && isset($map[$host])) {
            $db = $map[$host];
        }

        Config::set('database.connections.mysql.database', $db);
        DB::purge('mysql');
        DB::reconnect('mysql');

        return $next($request);
    }
}
