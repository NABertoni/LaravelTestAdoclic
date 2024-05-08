<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Entity;
use App\Models\Category;

class EntityTest extends TestCase
{
    public function test_entity_instance_can_be_created()
{
    $entity = new Entity();

    $this->assertInstanceOf(Entity::class, $entity);
}

public function test_entity_can_be_created_with_valid_data()
{
    $data = [
        'api' => 'Adoclic',
        'description' => 'Se utiliza para verificar que la inserción de datos en la tabla Entity funcione correctamente.',
        'link' => 'http://127.0.0.1:8000',
        'category_id' => 1,
    ];

    $entity = Entity::create($data);

    $this->assertEquals($data['api'], $entity->api);
    $this->assertEquals($data['description'], $entity->description);
    $this->assertEquals($data['link'], $entity->link);
    $this->assertEquals($data['category_id'], $entity->category_id);
}

}