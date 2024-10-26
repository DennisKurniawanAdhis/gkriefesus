<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
  
class AuthController extends Controller
{
    public function register()
    {
        return view('auth/register');
    }
  
    public function registerSave(Request $request)
    {
        Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required|confirmed'
        ])->validate();
  
        User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => 'super'
        ]);
  
        return redirect()->route('login');
    }
  
    public function login()
    {
        return view('auth/login');
    }
  
    public function loginAction(Request $request)
    {
        Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required'
        ])->validate();
  
        if (!Auth::attempt($request->only('username', 'password'), $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'username' => trans('auth.failed')
            ]);
        }
  
        
        $user = Auth::user();
        if ($user->role == 'super') {
            $request->session()->regenerate();
            // Jika role 'super', arahkan ke dashboard dan batasi akses ke halaman lain
            return redirect()->route('super');
        } elseif ($user->role == 'keanggotaan') {
            $request->session()->regenerate();
            // Jika role 'keanggotaan', arahkan ke halaman anggota
            return redirect()->route('keanggotaan');
        } elseif ($user->role == 'keuangan') {
            $request->session()->regenerate();
            // Jika role 'keuangan', arahkan ke halaman keuangan
            return redirect()->route('keuangan');
        }
    }
  
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
  
        $request->session()->invalidate();
  
        return redirect('/');
    }
 
    public function profile()
    {
        return view('profile');
    }

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
        $adminAnggota = User::findOrFail($id);
  
        return view('adminAnggota.edit', compact('adminAnggota'));
    }
  
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $adminAnggota = User::findOrFail($id);
  
        $adminAnggota->update($request->all());
  
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