<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Team extends Model
{
    use HasFactory;

    protected $table = 'team';
    protected $primaryKey = 'id_team';
    protected $connection = 'pgsql';
    protected $fillable = [
        'id_team',
        'name',
        'league', 
        'country',
    ];
    public function players(){
        return $this->hasMany(Player::class, 'team_id', 'id_team');
    }

}
