<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'reference', 'client_id', 'amount', 'status',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
