<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;

class ChangeAppLocale
{

    private function parseLocale($locale): ?string
    {
        if (!$locale) {
            return null;
        }

        if (strlen($locale) > 2) {
            return str_split($locale, 2)[0];
        }
        return $locale;
    }

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param \Closure(Request): (Response|RedirectResponse) $next
     * @return Response|RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        App::setLocale($this->parseLocale($request->header('locale')));

        return $next($request);
    }
}
