<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Category;

class CategoryTest extends TestCase
{
    /*
     * @return void
     */
    public function test_category_instance_can_be_created()
    {
        $category = new Category();

        $this->assertInstanceOf(Category::class, $category);
    }

    /*
     * @return void
     */
    public function test_category_can_be_created_with_valid_data()
    {
        $data = [
            'category' => 'Test Category',
        ];

        $category = Category::create($data);

        $this->assertEquals($data['category'], $category->category);
    }
}
