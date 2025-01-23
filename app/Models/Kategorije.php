<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategorije extends Model
{
    use HasFactory;

    // Definiši ime tabele (ako je potrebno)
    protected $table = 'kategorije';

    protected $fillable = [
        'naziv',
    ];

    // Relacija sa artiklima
    public function artikli()
    {
        return $this->hasMany(Artikli::class, 'kategorije_id');
    }
}

