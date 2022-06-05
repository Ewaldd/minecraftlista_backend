<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Server extends Model {
    use HasFactory;

    protected $fillable = ['hostname', 'ip', 'port', 'players', 'max_players'];

    public function votes() {
        return $this->hasMany(Vote::class, 'server_id');
    }

    public function categories() {
        return $this->hasMany(ServerCategories::class, 'server_id')->with('category');
    }
}
