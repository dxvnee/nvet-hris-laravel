<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    /**
     * Display a listing of employees.
     */
    public function index(Request $request)
    {
        $query = User::where('role', 'pegawai');

        // Search functionality
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('jabatan', 'like', "%{$search}%");
            });
        }

        // Filter by jabatan
        if ($request->has('jabatan') && $request->jabatan) {
            $query->where('jabatan', $request->jabatan);
        }

        // Sorting
        $sortBy = $request->get('sort', 'name');
        $sortDir = $request->get('dir', 'asc');
        $query->orderBy($sortBy, $sortDir);

        $users = $query->paginate(10)->withQueryString();

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new employee.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created employee in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'jabatan' => ['required', 'in:FO,Dokter,Tech,Paramedis'],
            'gaji_pokok' => ['required', 'numeric', 'min:0'],
            'jam_kerja' => ['required', 'integer', 'min:1', 'max:24'],
            'hari_libur' => ['nullable', 'array'],
            'hari_libur.*' => ['integer', 'min:0', 'max:6'],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'jabatan' => $request->jabatan,
            'gaji_pokok' => $request->gaji_pokok,
            'jam_kerja' => $request->jam_kerja,
            'hari_libur' => $request->hari_libur ?? [],
            'role' => 'pegawai',
        ]);

        return redirect()->route('users.index')->with('success', 'Pegawai berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified employee.
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified employee in storage.
     */
    public function update(Request $request, User $user)
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'jabatan' => ['required', 'in:FO,Dokter,Tech,Paramedis'],
            'gaji_pokok' => ['required', 'numeric', 'min:0'],
            'jam_kerja' => ['required', 'integer', 'min:1', 'max:24'],
            'hari_libur' => ['nullable', 'array'],
            'hari_libur.*' => ['integer', 'min:0', 'max:6'],
        ];

        // Only validate password if provided
        if ($request->filled('password')) {
            $rules['password'] = ['confirmed', Rules\Password::defaults()];
        }

        $request->validate($rules);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'jabatan' => $request->jabatan,
            'gaji_pokok' => $request->gaji_pokok,
            'jam_kerja' => $request->jam_kerja,
            'hari_libur' => $request->hari_libur ?? [],
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('users.index')->with('success', 'Data pegawai berhasil diperbarui!');
    }

    /**
     * Remove the specified employee from storage.
     */
    public function destroy(User $user)
    {
        if ($user->role === 'admin') {
            return redirect()->route('users.index')->with('error', 'Tidak dapat menghapus akun admin!');
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'Pegawai berhasil dihapus!');
    }
}
