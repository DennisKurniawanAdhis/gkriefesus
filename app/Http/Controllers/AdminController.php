<?php




  namespace App\Http\Controllers;
  use Illuminate\Support\Facades\Auth;
  use Illuminate\Http\Request;
  use Illuminate\Foundation\Auth\User;
  use Illuminate\Support\Facades\Hash;
  use Illuminate\Validation\Rule;
  
  class AdminController extends Controller
  {
      /**
       * Display a listing of the resource.
       */
      public function index()
      {
        if (!Auth::check() || Auth::user()->role !== 'super' ) {
            return redirect()->back();
        }
          $admin = User::simplepaginate(5);
          $superAdminCount = User::where('role', 'super')->count();
      
          return view('admin.index', compact('admin', 'superAdminCount'));
      }
    
      /**
       * Show the form for creating a new resource.
       */
      public function create()
      {
        if (!Auth::check() || Auth::user()->role !== 'super' ) {
            return redirect()->back();
        }
        $role = [
            'keanggotaan' => 'keanggotaan',
            'keuangan' => 'keuangan',
        ];
        return view('admin.create', compact('role'));
      }
    
      /**
       * Store a newly created resource in storage.
       */
      public function store(Request $request)
      {
        if (!Auth::check() || Auth::user()->role !== 'super' ) {
            return redirect()->back();
        }
        $validatedData = $request->validate([
            'username' => 'required|string|max:255|unique:users,username',
            'password' =>  [
              'required',
              'string',
              'min:6',
              'regex:/[A-Z]/'
            ],
        ], [
            'username.unique' => 'Username sudah digunakan, Silakan pilih username lain.',
            'password.required' => 'Password diperlukan.',
            'password.min' => 'Password harus minimal 6 karakter.',
            'password.regex' => 'Password harus mengandung setidaknya satu huruf besar.',
        ]);
      

        $admin = new User();
        $admin->username = $request->username;
        $admin->password = Hash::make($request->password); // Hash password dengan benar
        $admin->role = $request->role;
        $admin->save();  // Simpan data anggota
   
          return redirect()->route('admin')->with('success', 'Admin added successfully');
      }
    
      /**
       * Display the specified resource.
       */
      /**
       * Show the form for editing the specified resource.
       */
      public function edit(string $id)
      {
        if (!Auth::check() || Auth::user()->role !== 'super' ) {
            return redirect()->back();
        }
          // Temukan user berdasarkan ID
          $admin = User::where('id', $id)->firstOrFail();
    
    // Set role berdasarkan kondisi
    $role = [];
    if ($admin->role === 'super') {
        $role = [
            'super' => 'super'
        ];
    } else {
        $role = [
            'keanggotaan' => 'keanggotaan',
            'keuangan' => 'keuangan',
        ];
    }

    
          // Tampilkan form edit
          return view('admin.edit', compact('admin','role'));
      }
    
      /**
       * Update the specified resource in storage.
       */
      public function update(Request $request, string $id)
      {
        if (!Auth::check() || Auth::user()->role !== 'super' ) {
            return redirect()->back();
        }
        $admin = User::findOrFail($id);

       

    $validatedData = $request->validate([
        'username' => [
            'required', 
            'string', 
            'max:255', 
            Rule::unique('users', 'username')->ignore($id)
        ],
        'password' =>  [
            'required',
            'string',
            'min:6',
            'regex:/[A-Z]/'
        ],
        'role' => 'required|string|in:keanggotaan,keuangan,super', // Add this line
    ], [
        'username.unique' => 'Username sudah digunakan, Silakan pilih username lain.',
        'password.required' => 'Password diperlukan.',
        'password.min' => 'Password harus minimal 6 karakter.',
        'password.regex' => 'Password harus mengandung setidaknya satu huruf besar.',
    ]);
      
        

          // Temukan user berdasarkan ID
          $admin = User::findOrFail($id);
      
          // Update nama
          $admin->username = $validatedData['username'];
      
          // Update password jika ada
          if (!empty($validatedData['password'])) {
              $admin->password = bcrypt($validatedData['password']);
          }
      
          // Update role
          $admin->role = $validatedData['role'];
      
          // Simpan perubahan
          $admin->save();
      
          // Redirect ke halaman yang sesuai setelah update berhasil
          return redirect()->route('admin')->with('success', 'Admin updated successfully!');
      }
      
    
      /**
       * Remove the specified resource from storage.
       */
     public function destroy(string $id)
{
    if (!Auth::check() || Auth::user()->role !== 'super' ) {
        return redirect()->back();
    }
    $admin = User::findOrFail($id);

    // Cek apakah admin yang ingin dihapus memiliki role 'super'
    if ($admin->role === 'super') {
        // Cek apakah ada admin lain dengan role 'super'
        $superAdminCount = User::where('role', 'super')->count();

        // Jika ini adalah satu-satunya admin 'super', maka jangan izinkan penghapusan
        if ($superAdminCount <= 1) {
            return redirect()->route('admin')->with('error', 'Tidak dapat menghapus admin dengan role "super" karena ini adalah satu-satunya admin.');
        }
    }

    // Hapus admin jika tidak memenuhi syarat di atas
    $admin->delete();

    return redirect()->route('admin')->with('success', 'Admin Anggota deleted successfully');
}

  }