<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Radnici;
use Illuminate\Http\Request;

class RadniciController extends Controller
{
    
    public function index()
    {
        $radnici = User::where('role', 'radnik')->get(); // Ispis samo radnika
        return view('admin.radnici.index', compact('radnici'));
    }

    // Prikaz forme za kreiranje novog radnika
    public function create()
    {
        return view('admin.radnici.create'); // Forma za dodavanje radnika
    }

    // Spremanje novog radnika
    public function store(Request $request)
    {
        // Validacija
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|string|in:radnik',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Kreiranje novog radnika
        $radnik = new User();
        $radnik->name = $validated['name'];
        $radnik->email = $validated['email'];
        $radnik->role = $validated['role'];
        $radnik->password = bcrypt($validated['password']); 

        // Provjera da li je unos uspješan
        if ($radnik->save()) {
            return redirect()->route('admin.radnici.index')->with('success', 'Radnik je uspješno dodan.');
        } else {
            return redirect()->back()->with('error', 'Došlo je do greške prilikom dodavanja radnika.');
        }
    }

    // Prikaz forme za editovanje radnika
    public function edit($id)
{
    $radnik = User::findOrFail($id); // Pronađi radnika po ID-u
    return view('admin.radnici.edit', compact('radnik')); // Vraća formu za editovanje
}

    // Ažuriranje radnika
    public function update(Request $request, $id)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $id,
        'role' => 'required|string|in:radnik',
        'password' => 'nullable|string|min:8|confirmed', 
    ]);

    $radnik = User::findOrFail($id);
    $radnik->name = $validated['name'];
    $radnik->email = $validated['email'];
    $radnik->role = $validated['role'];

    if ($validated['password']) {
        $radnik->password = bcrypt($validated['password']);
    }

    $radnik->save();

    return redirect()->route('admin.radnici.index')->with('success', 'Radnik je uspešno ažuriran.');
}

    // Brisanje radnika
    public function destroy($id)
    {
        $radnik = User::findOrFail($id);
        $radnik->delete();
        
        return redirect()->route('admin.radnici.index')->with('success', 'Radnik uspješno obrisan.');
    }
}
