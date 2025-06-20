<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LigneDocument extends Model
{
    protected $fillable = ['document_id', 'designation', 'quantite', 'prix_unitaire', 'total'];

    public function document()
    {
        return $this->belongsTo(Document::class);
    }
}
