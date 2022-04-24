<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Team;
use App\Models\Player;
use Exception;
class PlayerController extends Controller
{
    public function createPlayer (Request $request) {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|between:2,100',
                'age' => 'required',
                'team_id' => 'required',
                'squad_number' => 'required',
                'position' => 'required',
                'nationality' => 'required',
            ],[
                'name.required'=>'Se requiere un nombre',
                'age.required'=>'Se requiere una edad',
                'team_id.required'=>'Se requiere un equipo',
                'squad_number.required'=>'Se requiere un squad number',
                'position.required'=>'Se requiere una posicion',
                'nationality.required'=>'Se requiere una nacionalidad', 
            ]);
            if ($validator->fails()){
                return response()->json(['error'=>$validator->errors()->first()]);
            }
            $team = Team::where('id_team','=',$request->team_id)->first();
            if(!$team) {
                return response()->json(['error'=>'no existe el equipo en referencia']);
            }
            $player = Player::create($validator->validated());
            return response()->json($player);
        } catch (Exception $e) { 
            return response()->json(['error' => $e->getMessage()], 500);
        }   
    }

    public function updatePlayer (Request $request) {
        try {
            $validator = Validator::make($request->all(), [
                'id_player' => 'required',
                'name' => 'required|string|between:2,100',
                'age' => 'required',
                'team_id' => 'required',
                'squad_number' => 'required',
                'position' => 'required',
                'nationality' => 'required',
            ],[
                'id_player.required'=>'Se requiere un id del jugador',
                'name.required'=>'Se requiere un nombre',
                'age.required'=>'Se requiere una edad',
                'team_id.required'=>'Se requiere un equipo',
                'squad_number.required'=>'Se requiere un squad number',
                'position.required'=>'Se requiere una posicion',
                'nationality.required'=>'Se requiere una nacionalidad', 
            ]);
            if ($validator->fails()){
                return response()->json(['error'=>$validator->errors()->first()]);
            }
            $player = Player::where('id_player','=',$request->id_player)->first();
            if($player) {
                $player->name = $request->name;
                $player->age = $request->age;
                $player->team_id = $request->team_id;
                $player->squad_number = $request->squad_number;
                $player->position = $request->position;
                $player->nationality = $request->nationality;
                $player->save();
                return response()->json($player);
            } else {
                return response()->json(['error'=>'El Jugador no existe']);
            }
        } catch (Exception $e) { 
            return response()->json(['error' => $e->getMessage()], 500);
        } 
    }
    
    public function editPlayer (Request $request) {
        try {
            $validator = Validator::make($request->all(), [
                'id_player' => 'required',
            ],[
                'id_player.required'=>'Se requiere un id del equipo',
            ]);
            if ($validator->fails()){
                return response()->json(['error'=>$validator->errors()->first()]);
            }
            $player = Player::where('id_player','=',$request->id_player)->first();
            if($player) {
                $request->name ? $player->name = $request->name : null;
                $request->age ? $player->age = $request->age : null;
                $request->team_id ? $player->team_id = $request->team_id : null;
                $request->squad_number ? $player->squad_number = $request->squad_number : null;
                $request->position ? $player->position = $request->position : null;
                $request->nationality ? $player->nationality = $request->nationality : null;

                $player->save();
                return response()->json($player);
            } else {
                return response()->json(['error'=>'El equipo no existe']);
            }
        } catch (Exception $e) { 
            return response()->json(['error' => $e->getMessage()], 500);
        } 
    }
    public function getAllPlayers () {
        try {
            $player = Player::with('team')->get();
            return response()->json($player);
        } catch (Exception $e) { 
            return response()->json(['error' => $e->getMessage()], 500);
        } 
    }
    public function getPlayer (Request $request) {
        try {
            $validator = Validator::make($request->all(), [
                'id_player' => 'required',
            ],[
                'id_player.required'=>'Se requiere un id del equipo',
            ]);
            if ($validator->fails()){
                return response()->json(['error'=>$validator->errors()->first()]);
            }
            $player = Player::where('id_player','=',$request->id_player)->first();
            if($player) {
                return response()->json($player);
            } else {
                return response()->json(['error'=>'El jugador no existe']);
            }
        } catch (Exception $e) { 
            return response()->json(['error' => $e->getMessage()], 500);
        } 
    }
    public function detelePlayer (Request $request) {
        try {
            $validator = Validator::make($request->all(), [
                'id_player' => 'required',
            ],[
                'id_player.required'=>'Se requiere un id del jugador',
            ]);
            if ($validator->fails()){
                return response()->json(['error'=>$validator->errors()->first()]);
            }
            $player = Player::where('id_player','=',$request->id_player)->first();
            if($player) {
                $player->delete();
                return response()->json($player);
            } else {
                return response()->json(['error'=>'El jugador no existe']);
            }
        } catch (Exception $e) { 
            return response()->json(['error' => $e->getMessage()], 500);
        } 
    }

}
