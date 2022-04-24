<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Player extends Model
{
    use HasFactory;

    protected $table = 'player';
    protected $primaryKey = 'id_player';
    protected $connection = 'mysql';
    protected $fillable = [
        'id_player',
        'name',
        'age', 
        'team_id',
        'squad_number',
        'position',
        'nationality',
    ];

    public function team(){
        return $this->hasOne(Team::class, 'id_team', 'team_id');
    }
}
