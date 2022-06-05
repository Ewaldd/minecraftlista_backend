<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model {
    use HasFactory;

    public $timestamps = false;

    public function servers() {
        return $this->hasMany(ServerCategories::class, 'category_id')->with('server');
    }
}
