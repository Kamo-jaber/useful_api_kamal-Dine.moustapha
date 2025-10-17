<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\UserModule;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class UserModuleController extends Controller
{

    //logic d'activation

    public function activeModule($moduleId): JsonResponse
    {
        // verifier que l'utilisateur est connecter
        $user = Auth::User();
        //verifier que le module existe

        $module = Module::find($moduleId);

    if (!$module) {
        return response()->json(['message' => 'Module inexistant'], 404);
    };

    //faire une mise à jour de la table usermodule

    $userModule = UserModule::updateOrCreate(

        ['user_id'=>$user->id, 'module_id'=>$module],
        ['active' => true,]

    );

    return response()->json(['message' => 'Module activer avec succes'], 200);
    }

        public function desactiveModule($moduleId): JsonResponse
    {
        // verifier que l'utilisateur est connecter
        $user = Auth::User();
        //verifier que le module existe

        $module = Module::find($moduleId);

    if (!$module) {
        return response()->json(['message' => 'Module inexistant'], 404);
    };

    //faire une mise à jour de la table usermodule

    $userModule = UserModule::where('user_id', $user->id,)
                            ->where('module_id', $module)->first();

    if(!$userModule) {
        return response()->json(['message' => 'Module inexistant'], 404);
    }

   $userModule->update(['active' => false,]);


    return response()->json(['message' => 'Module activer avec succes'], 200);
    }
}
