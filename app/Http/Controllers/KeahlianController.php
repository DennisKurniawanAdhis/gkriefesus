<?php
  
namespace App\Http\Controllers;

use App\Models\Keahlian;
use Illuminate\Http\Request;
 
class KeahlianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $keahlian = Keahlian::all();
        return view('keahlian.index', compact('keahlian'));
    }
  
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('keahlian.create');
    }
  
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $keahlian = new Keahlian();
        $keahlian->keahlianID = $request->keahlianID; 
        $keahlian->namaKeahlian = $request->namaKeahlian;
        $keahlian->deskripsi = $request->deskripsi;
        $keahlian->save();  // Simpan data keahllian

        // Keahlian::create($request->all());
 
        return redirect()->route('keahlian')->with('success', 'Keahlian added successfully');
    }
  
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $keahlian = Keahlian::findOrFail($id);
  
        return view('keahlian.show', compact('keahlian'));
    }
  
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $keahlian = Keahlian::findOrFail($id);
  
        return view('keahlian.edit', compact('keahlian'));
    }
  
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $keahlian = Keahlian::findOrFail($id);
  
        $keahlian->update($request->all());
  
        return redirect()->route('keahlian')->with('success', 'Keahlian updated successfully');
    }
  
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $keahlian = Keahlian::findOrFail($id);
  
        $keahlian->delete();
  
        return redirect()->route('keahlian')->with('success', 'Keahlian deleted successfully');
    }
}