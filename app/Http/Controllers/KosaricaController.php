<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artikli;
use App\Models\Narudzba;

class KosaricaController extends Controller
{
    // Prikazuje sadržaj košarice
    public function index()
    {
        $kosarica = session()->get('kosarica', []);
        $ukupno = collect($kosarica)->sum(function ($item) {
            return $item['cijena'] * $item['kolicina'];
        });

        return view('kosarica.index', compact('kosarica', 'ukupno'));
    }

    // Dodaje artikl u košaricu
    public function dodaj(Request $request)
    {
        $artikl = Artikli::findOrFail($request->id);

        $kosarica = session()->get('kosarica', []);

        if (isset($kosarica[$artikl->id])) {
            $kosarica[$artikl->id]['kolicina']++;
        } else {
            $kosarica[$artikl->id] = [
                'naziv' => $artikl->naziv,
                'cijena' => $artikl->cijena,
                'kolicina' => 1,
                'slika' => $artikl->slika,
            ];
        }

        session()->put('kosarica', $kosarica);

        return redirect()->route('kosarica.index')->with('success', 'Artikl dodan u košaricu.');
    }

    // Ažurira količinu artikala u košarici
    public function azuriraj(Request $request)
    {
        $kosarica = session()->get('kosarica', []);
        $id = $request->input('id');
        $akcija = $request->input('akcija');

        if (isset($kosarica[$id])) {
            if ($akcija === 'povecaj') {
                $kosarica[$id]['kolicina']++;
            } elseif ($akcija === 'smanji' && $kosarica[$id]['kolicina'] > 1) {
                $kosarica[$id]['kolicina']--;
            }
        }

        session()->put('kosarica', $kosarica);

        return redirect()->route('kosarica.index')->with('success', 'Količina artikla ažurirana.');
    }

    // Uklanja artikl iz košarice
    public function ukloni(Request $request)
    {
        $kosarica = session()->get('kosarica', []);
        $id = $request->input('id');

        if (isset($kosarica[$id])) {
            unset($kosarica[$id]);
        }

        session()->put('kosarica', $kosarica);

        return redirect()->route('kosarica.index')->with('success', 'Artikl uklonjen iz košarice.');
    }

    // Čisti košaricu
    public function ocisti()
    {
        session()->forget('kosarica');
        return redirect()->route('kosarica.index')->with('success', 'Košarica je očišćena.');
    }

    // Završava narudžbu
    public function zavrsiNarudzbu(Request $request)
{
    // Validacija načina preuzimanja
    $request->validate([
        'nacin_preuzimanja' => 'required|string|in:preuzmi,dostava',
    ]);

    // Spremanje narudžbe u bazu
    $kosarica = session()->get('kosarica', []);
$ukupno = array_reduce($kosarica, function ($carry, $item) {
    return $carry + ($item['cijena'] * $item['kolicina']);
}, 0);

// Serijaliziraj košaricu u JSON
$kosarica_json = json_encode($kosarica);

// Kreiraj novu narudžbu
$narudzba = Narudzba::create([
    'user_id' => auth()->id(),
    'artikli' => $kosarica_json,  // Pohranjuje serijalizirane artikle
    'ukupno' => $ukupno,
    'nacin_preuzimanja' => $request->input('nacin_preuzimanja'),
    'status' => 'u procesu',
]);

// Očisti košaricu
session()->forget('kosarica');


    // Očistite košaricu
    session()->forget('kosarica');

    return redirect()->route('kosarica.index')->with('success', 'Narudžba je uspješno završena. ID narudžbe: ' . $narudzba->id);
}

    public function update(Request $request, $id)
    {
        $kosarica = session()->get('kosarica', []);

        if (isset($kosarica[$id])) {
            $kosarica[$id]['kolicina'] = $request->input('kolicina', 1);
        }

        session()->put('kosarica', $kosarica);

        return redirect()->route('kosarica.index')->with('success', 'Količina je ažurirana.');
    }
}
