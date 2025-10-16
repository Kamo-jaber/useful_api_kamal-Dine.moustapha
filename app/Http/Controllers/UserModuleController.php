<?php

namespace App\Http\Controllers;

use App\Models\User_module;
use Illuminate\Http\Request;

class UserModuleController extends Controller
{

    //logic d'activation

    public function activeModule($id): JsonResponse
    {
        $module = User_module::find($id);

    if (!$module) {
        return response()->json(['message' => 'Module inexistant'], 404);
    };

    $module->active = true;
    $module->save();

    return response()->json(['message' => 'User promoted to admin'], 200);
    }

     public function desactiveModule($id): JsonResponse
    {
        $module = User_module::find($id);

    if (!$module) {
        return response()->json(['message' => 'Module inexistant'], 404);
    };

    $module->active = false;
    $module->save();

    return response()->json(['message' => 'User promoted to admin'], 200);
    }
}
