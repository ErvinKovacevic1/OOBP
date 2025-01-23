<?php
namespace App\Http\Controllers;

use App\Models\Artikli;
use App\Models\Kategorije;  
use Illuminate\Http\Request;

class ArtikliController extends Controller
{
    public function index(Request $request)
    {
        // Preuzmi sve kategorije
        $kategorije = Kategorije::all();

        // Filtriranje artikala po kategoriji
        $artikliQuery = Artikli::query();

        if ($request->has('kategorija') && $request->kategorija != '') {
            $artikliQuery->where('kategorije_id', $request->kategorija);
        }

        $artikli = $artikliQuery->get();

        return view('artikli.index', compact('artikli', 'kategorije'));
    }


    public function create()
    {
        $kategorije = Kategorija::all(); // Povlačenje svih kategorija
        return view('artikli.create', compact('kategorije'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'naziv' => 'required',
            'cijena' => 'required|numeric',
            'kategorije_id' => 'required|exists:kategorije,id',
        ]);

        Artikli::create($request->all()); // Dodavanje novog artikla
        return redirect()->route('artikli.index');
    }

    public function edit(Artikli $artikal)
    {
        $kategorije = Kategorija::all(); // Povlačenje svih kategorija
        return view('artikli.edit', compact('artikal', 'kategorije'));
    }

    public function update(Request $request, Artikli $artikal)
    {
        $request->validate([
            'naziv' => 'required',
            'cijena' => 'required|numeric',
            'kategorije_id' => 'required|exists:kategorije,id',
        ]);

        $artikal->update($request->all()); // Ažuriranje artikla
        return redirect()->route('artikli.index');
    }

    public function destroy(Artikli $artikal)
    {
        $artikal->delete(); // Brisanje artikla
        return redirect()->route('artikli.index');
    }
}
