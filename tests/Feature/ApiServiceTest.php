<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Entity;
use App\Models\Category;
use App\Services\ApiService;
use GuzzleHttp\Client;

class ApiServiceTest extends TestCase
{    

    /**
     * Verifica que el servicio pueda obtener datos de la API y almacenarlos correctamente en la base de datos.
     *
     * @return void
     */
    public function testFetchAndStoreDataFromApi()
    {
        // Simula una solicitud HTTP a la API
        $client = new Client();
        $response = $client->get('https://api.publicapis.org/entries');
        $data = json_decode($response->getBody(), true);

        // Verifica que la solicitud a la API se haya realizado con éxito
        $this->assertEquals(200, $response->getStatusCode());

        // Ejecuta el método del servicio para almacenar los datos en la base de datos
        $apiService = new ApiService();
        $apiService->fetchEntitiesFromApi();

        // Verifica que los datos se hayan almacenado correctamente en la base de datos
        foreach ($data['entries'] as $entry) {
            $this->assertDatabaseHas('entities', [
                'api' => $entry['API'],
                'description' => $entry['Description'],
                'link' => $entry['Link'],
            ]);
        }
    }
}
