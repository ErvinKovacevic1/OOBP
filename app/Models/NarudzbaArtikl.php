<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NarudzbaArtikl extends Model
{
    protected $table = 'narudzba_artikl';

    protected $fillable = [
        'narudzba_id', 'artikl_id', 'kolicina', 'cijena'
    ];
}
