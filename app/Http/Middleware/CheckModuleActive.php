<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckModuleActive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //s'assure que l'utilisateur est connecter et si ce n'est pas le cas envoyer une erreur
        $user = Auth::user();
        if(!$user) {
            return response()->json(["error" => "Unauthorized"], 401);
        }

        //Faire une requettte sql à l'aide d'une variable pour verifier si le champ active est true afin de pouvoir donner l'access

        $isActive = UserModule::where('user_id', $user->id) -> where('module_id', $moduleId)-> where('active', true);

        if (!$isActive) {
            return response()->json(["error" => "Module inactive. Please activate this module to use it."], 403);
        }
        return $next($request);
    }
}
