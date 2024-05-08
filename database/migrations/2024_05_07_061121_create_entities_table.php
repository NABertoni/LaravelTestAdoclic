<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntitiesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // Verificar si la tabla 'entities' no existe
        if (!Schema::hasTable('entities')) {
            // Si la tabla 'entities' no existe, entonces crearla
            Schema::create('entities', function (Blueprint $table) {
                $table->id();
                $table->string('api');
                $table->text('description');
                $table->string('link');
                $table->unsignedBigInteger('category_id'); // Define la columna category_id
                $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade'); // Define la clave foránea
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('entities');
    }
}