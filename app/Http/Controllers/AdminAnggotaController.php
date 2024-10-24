<?php
  
  namespace App\Http\Controllers;

  use App\Models\Product;
  use Illuminate\Http\Request;
  use Illuminate\Foundation\Auth\User;
  use Illuminate\Support\Facades\Auth;
  use Illuminate\Support\Facades\Hash;
  
  class AdminAnggotaController extends Controller
  {
      /**
       * Display a listing of the resource.
       */
      public function index()
      {
          $adminAnggota = User::orderBy('created_at', 'DESC')->get();
    
          return view('adminAnggota.index', compact('adminAnggota'));
      }
    
      /**
       * Show the form for creating a new resource.
       */
      public function create()
      {
          return view('adminAnggota.create');
      }
    
      /**
       * Store a newly created resource in storage.
       */
      public function store(Request $request)
      {
          User::create($request->all());
   
          return redirect()->route('adminAnggota')->with('success', 'Admin Anggota added successfully');
      }
    
      /**
       * Display the specified resource.
       */
      public function show(string $id)
      {
          $adminAnggota = User::findOrFail($id);
    
          return view('adminAnggota.show', compact('adminAnggota'));
      }
    
      /**
       * Show the form for editing the specified resource.
       */
      public function edit(string $id)
      {
          // Temukan user berdasarkan ID
          $adminAnggota = User::findOrFail($id);
    
          // Tampilkan form edit
          return view('adminAnggota.edit', compact('adminAnggota'));
      }
    
      /**
       * Update the specified resource in storage.
       */
      public function update(Request $request, string $id)
      {
          // Validasi input
          $request->validate([
              'password' => 'nullable|min:8|confirmed', // Validasi password
          ]);
  
          // Temukan user berdasarkan ID
          $adminAnggota = User::findOrFail($id);
  
          // Jika input password ada, lakukan hashing dan update
          if ($request->filled('password')) {
              $adminAnggota->password = Hash::make($request->password);
          }
  
          // Update field lainnya
          $adminAnggota->update($request->except('password'));
  
          return redirect()->route('adminAnggota')->with('success', 'Admin Anggota updated successfully');
      }
    
      /**
       * Remove the specified resource from storage.
       */
      public function destroy(string $id)
      {
          $adminAnggota = User::findOrFail($id);
    
          $adminAnggota->delete();
    
          return redirect()->route('adminAnggota')->with('success', 'Admin Anggota deleted successfully');
      }
  }
  