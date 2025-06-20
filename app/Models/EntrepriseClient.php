<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntrepriseClient extends Model
{
    use HasFactory;

    protected $fillable = [
        'agence_id', 'nom', 'domaine', 'adresse', 'email', 'logo', 'telephone'
    ];

    public function agence()
    {
        return $this->belongsTo(Agence::class);
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }
    public function clientsFinaux()
    {
        return $this->hasMany(ClientFinal::class);
    }

}
