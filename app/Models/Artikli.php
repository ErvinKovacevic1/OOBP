<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artikli extends Model
{
    use HasFactory;

    // Definiši ime tabele
    protected $table = 'artikli';

    protected $fillable = [
        'naziv',
        'opis',
        'cijena',
        'slika',
        'kategorije_id',
        'kolicina_na_stanju',
    ];

    // Relacija sa kategorijama
    public function kategorija()
    {
        return $this->belongsTo(Kategorije::class, 'kategorije_id');
    }
    // app/Models/Artikl.php

    public function narudzbe()
    {
        return $this->belongsToMany(Narudzba::class, 'narudzba_artikl', 'artikl_id', 'narudzba_id')
                    ->withPivot('kolicina', 'cijena');
    }
   

    
}




