<?php

namespace App\Services;

use App\Models\Entity;
use App\Models\Category;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class ApiService
{
    /**     
     * @return void
     */
    public function fetchEntitiesFromApi()
    {
        try {
            $client = new Client();
            $response = $client->get('https://api.publicapis.org/entries');

            if ($response->getStatusCode() >= 200 && $response->getStatusCode() < 300) {
                $data = json_decode($response->getBody(), true);
                $filteredEntities = $this->filterEntities($data['entries']);
                $this->insertEntitiesIntoDatabase($filteredEntities);
                
                Log::info('Consulta a la API realizada con éxito.');
            } else {
                Log::warning('La consulta a la API no devolvió un estado exitoso.');
            }
        } catch (\Exception $e) {
            Log::error('Error al realizar la consulta a la API: ' . $e->getMessage());
           
        }
    }

    /**
     *
     * @param array $entries
     * @return array
     */
    private function filterEntities($entries)
    {
        return array_filter($entries, function ($entry) {
            return strpos(strtolower($entry['Category']), 'animals') !== false ||
                   strpos(strtolower($entry['Category']), 'security') !== false;
        });
    }

    /**     
     * @param array $entities
     * @return void
     */
    private function insertEntitiesIntoDatabase($entities)
    {
        foreach ($entities as $entity) {
            $categoryId = $this->getCategoryId($entity['Category']);

            Entity::create([
                'api' => $entity['API'],
                'description' => $entity['Description'],
                'link' => $entity['Link'],
                'category_id' => $categoryId,
            ]);
        }
    }

    /**
     * @param string $category
     * @return int
     */
    private function getCategoryId($category)
    {
        $categoryModel = Category::firstOrCreate(['category' => $category]);

        return $categoryModel->id;
    }
}
