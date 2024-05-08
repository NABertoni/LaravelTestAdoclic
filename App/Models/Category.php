<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Entity;

class Category extends Model
{
    protected $fillable = ['category'];

    
    public function entities()
    {
        return $this->hasMany(Entity::class);
    }
}

