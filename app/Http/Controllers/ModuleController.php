<?php

namespace App\Http\Controllers;

use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ModuleController extends Controller
{
    /**
     * Display a listing of the modules.
     */
    public function getModules(): JsonResponse
    {
        $modules = Module::all();
        return response()->json($modules, 200);
    }

}
