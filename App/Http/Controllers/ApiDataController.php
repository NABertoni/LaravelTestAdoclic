<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entity;

class ApiDataController extends Controller
{
    /**     
     * @param  string  $category
     * @return \Illuminate\Http\Response
     */
    public function getDataByCategory($category)
    {
       
        $entities = Entity::whereHas('category', function ($query) use ($category) {
            $query->where('category', $category);
        })->get();

        
        $formattedData = [];
        foreach ($entities as $entity) {
            $formattedData[] = [
                'api' => $entity->api,
                'description' => $entity->description,
                'link' => $entity->link,
                'category' => [
                    'id' => $entity->category->id,
                    'category' => $entity->category->category
                ]
            ];
        }

       
        return response()->json(['success' => true, 'data' => $formattedData]);
    }
}
