<?php

    namespace App\Http\Middleware;

    use Closure;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use Symfony\Component\HttpFoundation\Response;

    class RoleAccessMiddleware
    {
        /**
         * Handle an incoming request.
         *
         * @param Closure(Request): (Response) $next
         */
        public function handle(Request $request, Closure $next, ...$roles): Response
        {
            if (!Auth::check()) {
                return redirect()->route('login');
            }

            if (!Auth::user()->hasAnyRole($roles)) {
                abort(403, 'Unauthorized action');
            }

            return $next($request);
        }
    }
