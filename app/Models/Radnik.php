<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Radnik extends Model
{
    use HasFactory;
    protected $table = 'radnici';
    protected $fillable = [
        'ime',
        'prezime',
        'email',
        'telefon',
        'adresa',
        'status',
    ];
}

