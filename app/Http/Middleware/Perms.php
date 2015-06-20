<?php namespace App\Http\Middleware;

use App\Library\PermsLib;
use App\Library\RequestParser;
use Closure;
use Illuminate\Support\Facades\DB;

class Perms {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
        $route = app()->router->getRoutes()->match($request);

        if(is_string($route->getAction()['uses'])) {
            if(auth()->check() && isset(auth()->user()->id)){

                list($controller,$method) = PermsLib::getControllerMethod($route->getAction()['uses']);

                if($controller!="auth\\authcontroller")
                    if (!PermsLib::isPermControl($controller,$method))
                        return response()->view('errors.custom',['content'=>trans('app.access_denied')]);
            }
        }else return response()->view('errors.custom',['content'=>trans('app.access_denied')]);

		return $next($request);
	}

}
