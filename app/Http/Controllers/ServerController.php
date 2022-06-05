<?php

namespace App\Http\Controllers;

use App\Models\Server;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ServerController extends Controller {
    public function index() {
        $servers = Server::withCount('votes')->orderByDesc('votes_count')->get();
        return response()->json(['servers' => $servers, 'success' => true]);
    }

    public function store(Request $request) {
        if (!isset($request->ip)) {
            return response()->json(['success' => false, 'message' => "Musisz podać IP serwera!"]);
        }
        $ip = $request->ip;
        /*
         * Zapytanie do zewnętrznego serwisu w celu uzyskania informacji o statusie serwera Minecraft.
         */
        $status = HTTP::get("https://gamedata-api.okaeri.eu/v1/minecraftjava/{$ip}/info");
        if (isset($status['status'])) {
            switch ($status['status']) {
                case 400:
                    return response()->json(['success' => false, 'message' => "Podałeś błędny adres serwera."]);
                case 409:
                    return response()->json(['success' => false, 'message' => "Podany serwer jest nieosiągalny."]);
            }
        }
        if (Server::where(['hostname' => $request->ip])->count() != 0) {
            return response()->json(['message' => 'Ten serwer jest już dodany.', 'server' => Server::where(['hostname' => $request->ip])->withCount('votes')->first()]);
        }
        $server = new Server();
        $server->hostname = $request->ip;
        $server->ip = $status['address']['ip'];
        $server->port = $status['address']['port'];
        $server->players = $status['players']['online'];
        $server->max_players = $status['players']['max'];
        $server->save();
        return response()->json(['success' => true, 'server' => $server]);
    }

    public function show($id) {
        $server = Server::where(['id' => $id])->withCount('votes')->with('categories')->first();
        if (is_null($server)) {
            return response()->json(['success' => false, 'message' => "Podany serwer nie istnieje!"]);
        }
        return response()->json(['success' => true, 'server' => $server]);
    }
}
