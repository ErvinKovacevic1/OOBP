<?php

namespace App\Http\Controllers;

use App\Models\Narudzba;
use Illuminate\Http\Request;

class RadniciNarudzbeController extends Controller
{
    // Prikaz svih narudžbi za radnike
    public function index()
    {
        $narudzbe = Narudzba::all(); // Dobavlja sve narudžbe
        $statusi = ['u procesu', 'u pripremi', 'završena', 'odbijena']; // Mogući statusi

        return view('radnici.narudzbe.index', compact('narudzbe', 'statusi'));
    }

    // Promjena statusa narudžbe
    public function promijeniStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:u procesu,u pripremi,završena,odbijena',
        ]);

        $narudzba = Narudzba::findOrFail($id);
        $narudzba->status = $request->input('status');
        $narudzba->save();

        return redirect()->route('radnici.narudzbe.index')->with('success', 'Status narudžbe uspješno ažuriran.');
    }
}
