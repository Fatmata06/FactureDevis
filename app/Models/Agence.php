<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agence extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'email', 'mdp'];

    public function entreprises()
    {
        return $this->hasMany(EntrepriseClient::class);
    }
}

