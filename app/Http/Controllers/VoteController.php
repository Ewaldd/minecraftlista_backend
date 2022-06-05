<?php

namespace App\Http\Controllers;

use App\Models\Server;
use App\Models\Vote;
use Illuminate\Http\Request;

class VoteController extends Controller {

    public function store(Request $request) {
        $server = Server::where(['id' => $request->server_id])->withCount('votes')->first();
        if ($server == null) {
            return response()->json(['success' => false, 'message' => "Podany serwer nie istnieje!"]);
        }
        $vote = new Vote();
        $vote->server_id = $server->id;
        $vote->save();
        return response()->json(['success' => true, 'message' => 'Zagłosowałeś!']);
    }
}
