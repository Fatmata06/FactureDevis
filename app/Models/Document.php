<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'entreprise_client_id',
        'client_final_id',
        'type',
        'reference',
        'date',
       
        'main_oeuvre', 
        'statut',
    ];

    public function entreprise()
    {
        return $this->belongsTo(EntrepriseClient::class, 'entreprise_client_id');
    }

    public function client()
    {
        return $this->belongsTo(ClientFinal::class, 'client_final_id');
    }

    public function lignes()
    {
        return $this->hasMany(LigneDocument::class);
    }
    public function isFacture()
    {
        return $this->type === 'facture';
    }

    public function isDevis()
    {
        return $this->type === 'devis';
    }

}
