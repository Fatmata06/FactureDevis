<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientFinal extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'prenom'];

    public function documents()
    {
        return $this->hasMany(Document::class);
    }
    public function entrepriseClient()
    {
        return $this->belongsTo(EntrepriseClient::class);
    }
}
