<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Narudzba extends Model
{
    use HasFactory;
    protected $table = 'narudzbe';
    protected $fillable = [
        'user_id',
        'artikli',
        'ukupno',
        'nacin_preuzimanja',
        'status',
    ];

    // Ako želiš validirati status prije spremanja
    public static $statuses = ['čekanje', 'priprema', 'gotovo'];

    // Dodaj ako želiš dodatne funkcionalnosti
    public function setStatus($status)
    {
        if (in_array($status, self::$statuses)) {
            $this->status = $status;
            $this->save();
        }
    }
    public function user()
    {
        return $this->belongsTo(User::class); // Provjeri ako je User model ispravno povezan
    }
    
    public function artikli()
{
    return $this->belongsToMany(Artikli::class, 'narudzba_artikl', 'narudzba_id', 'artikl_id')
                ->withPivot('kolicina', 'cijena');
}


}

