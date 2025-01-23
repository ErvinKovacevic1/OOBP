<?php

namespace App\Http\Controllers;

use App\Models\Artikli;
use App\Models\Narudzba;
use App\Models\Analitika; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NarudzbaController extends Controller
{
    public function index()
    {
        // Učitavanje narudžbi sa povezanim artiklima
        $narudzbe = Narudzba::with('artikli')->get();
        return view('narudzbe.index', compact('narudzbe'));
    }
    
    public function promijeniStatus(Request $request, $id)
    {
        $narudzba = Narudzba::findOrFail($id);
        $narudzba->status = $request->status;
        $narudzba->save();

        return redirect()->route('narudzbe.index');
    }

    public function updateStatus(Request $request, $id)
    {
        $narudzba = Narudzba::findOrFail($id);
        $narudzba->status = $request->status;  // Postavi novi status
        $narudzba->save();

        return redirect()->route('narudzbe.index');
    }

    public function show(Narudzba $narudzba)
    {
        $artikli = $narudzba->artikli; 
        return view('narudzbe.show', compact('narudzba', 'artikli'));
    }

    
}
