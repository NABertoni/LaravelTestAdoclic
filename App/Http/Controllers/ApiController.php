<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ApiService;
use App\Models\Entity;

class ApiController extends Controller
{
    /**         
     * @param  \App\Services\ApiService  $apiService
     * @return \Illuminate\Http\Response
     */
    public function fetchAndInsert(ApiService $apiService)
    {
        
        $apiService->fetchEntitiesFromApi();

        
        return response()->json(['message' => 'Datos actualizados exitosamente'], 200);
    }

}
