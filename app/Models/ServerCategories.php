<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServerCategories extends Model {
    use HasFactory;

    public function category() {
        return $this->belongsTo(Category::class, 'id');
    }

    public function server() {
        return $this->belongsTo(Server::class, 'server_id');
    }
}
