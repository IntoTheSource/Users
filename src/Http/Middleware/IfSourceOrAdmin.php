<?php

namespace IntoTheSource\Users\Http\Middleware;

use Config;
use config('entrance.classes.user_model') as User;
use Closure;

class IfSourceOrAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (UserManager::hasRoles(['admin']) OR UserManager::hasRoles(['source'])) {
            return $next($request);
        }
        $request->session()->flash('message', 'U heeft niet de juiste rechten om de gezochte pagina te bekijken.');
        return \Redirect::route('login.index');
    }
}