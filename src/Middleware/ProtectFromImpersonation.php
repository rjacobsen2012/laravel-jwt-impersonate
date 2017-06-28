<?php

namespace Incorp\Impersonate\Middleware;

use Closure;
use Incorp\Impersonate\Exceptions\ProtectedAgainstImpersonationException;
use Incorp\Impersonate\Services\ImpersonateManager;

class ProtectFromImpersonation
{
    /**
     * Handle an incoming request.
     *
     * @param   \Illuminate\Http\Request  $request
     * @param   \Closure  $next
     * @return  mixed
     */
    public function handle($request, Closure $next)
    {
        $impersonate_manager = app()->make(ImpersonateManager::class);

        if ($impersonate_manager->isImpersonating()) {
            throw new ProtectedAgainstImpersonationException();
        }

        return $next($request);
    }
}
