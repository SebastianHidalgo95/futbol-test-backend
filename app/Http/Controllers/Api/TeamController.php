<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Team;
use Exception;
class TeamController extends Controller
{
    public function createTeam (Request $request) {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|between:2,100',
                'league' => 'required|string|between:2,100',
                'country' => 'required|string|between:2,100',
            ],[
                'name.required'=>'Se requiere un nombre',
                'league.required'=>'Se requiere una liga',
                'country.required'=>'Se requiere un país',
            ]);
            if ($validator->fails()){
                return response()->json(['error'=>$validator->errors()->first()]);
            }
            $team = Team::create($validator->validated());
            return response()->json($team);
        } catch (Exception $e) { 
            return response()->json(['error' => $e->getMessage()], 500);
        }   
    }

    public function updateTeam (Request $request) {
        try {
            $validator = Validator::make($request->all(), [
                'id_team' => 'required',
                'name' => 'required|string|between:2,100',
                'league' => 'required|string|between:2,100',
                'country' => 'required|string|between:2,100',
            ],[
                'id_team.required'=>'Se requiere un id del equipo',
                'name.required'=>'Se requiere un nombre',
                'league.required'=>'Se requiere una liga',
                'country.required'=>'Se requiere un país',
            ]);
            if ($validator->fails()){
                return response()->json(['error'=>$validator->errors()->first()]);
            }
            $team = Team::where('id_team','=',$request->id_team)->first();
            if($team) {
                $team->name = $request->name;
                $team->league = $request->league;
                $team->country = $request->country;
                $team->save();
                return response()->json($team);
            } else {
                return response()->json(['error'=>'El equipo no existe']);
            }
        } catch (Exception $e) { 
            return response()->json(['error' => $e->getMessage()], 500);
        } 
    }
    public function editTeam (Request $request) {
        try {
            $validator = Validator::make($request->all(), [
                'id_team' => 'required',
            ],[
                'id.required'=>'Se requiere un id del equipo',
            ]);
            if ($validator->fails()){
                return response()->json(['error'=>$validator->errors()->first()]);
            }
            $team = Team::where('id_team','=',$request->id_team)->first();
            if($team) {
                $request->name ? $team->name = $request->name : null;
                $request->league ? $team->name = $request->league : null;
                $request->country ? $team->name = $request->country : null;

                $team->save();
                return response()->json($team);
            } else {
                return response()->json(['error'=>'El equipo no existe']);
            }
        } catch (Exception $e) { 
            return response()->json(['error' => $e->getMessage()], 500);
        } 
    }
    public function getAllTeams () {
        try {
            $teams = Team::with('players')->get();
            return response()->json($teams);
        } catch (Exception $e) { 
            return response()->json(['error' => $e->getMessage()], 500);
        } 
    }
    public function getTeam (Request $request) {
        try {
            $validator = Validator::make($request->all(), [
                'id_team' => 'required',
            ],[
                'id_team.required'=>'Se requiere un id del equipo',
            ]);
            if ($validator->fails()){
                return response()->json(['error'=>$validator->errors()->first()]);
            }
            $team = Team::where('id_team','=',$request->id_team)->with('players')->first();
            if($team) {
                return response()->json($team);
            } else {
                return response()->json(['error'=>'El equipo no existe']);
            }
        } catch (Exception $e) { 
            return response()->json(['error' => $e->getMessage()], 500);
        } 
    }
    public function deteleTeam (Request $request) {
        try {
            $validator = Validator::make($request->all(), [
                'id_team' => 'required',
            ],[
                'id_team.required'=>'Se requiere un id del equipo',
            ]);
            if ($validator->fails()){
                return response()->json(['error'=>$validator->errors()->first()]);
            }
            $team = Team::where('id_team','=',$request->id_team)->first();
            if($team) {
                $team->delete();
                return response()->json($team);
            } else {
                return response()->json(['error'=>'El equipo no existe']);
            }
        } catch (Exception $e) { 
            return response()->json(['error' => $e->getMessage()], 500);
        } 
    }

}
