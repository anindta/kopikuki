<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\imageHelper;
use App\Models\User;
use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::orderBy('updated_at', 'desc')->get();
        return view('backend.v_user.index', [
            'judul' => 'Data User',
            'index' => $user
        ]);
    }

    public function create()
    {
        return view('backend.v_user.create', [
            'judul' => 'Tambah User',
        ]);
    }
    public function show(string $id) 
    { 
        $produk = Produk::with('fotoProduk')->findOrFail($id); 
        $kategori = Kategori::orderBy('nama_kategori', 'asc')->get(); 
        return view('backend.v_produk.show', [ 
            'judul' => 'Detail Produk', 
            'show' => $produk, 
            'kategori' => $kategori 
        ]); 
    } 
    public function edit(string $id)
    {
        $user = User::findOrFail($id);

        return view('backend.v_user.edit', [
            'judul' => 'Ubah User',
            'edit' => $user
        ]);

    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'nama' => 'required|max:255',
            'email' => 'required|max:255|email|unique:user',
            'role' => 'required',
            'hp' => 'required|min:10|max:13',
            'password' => 'required|min:4|confirmed',
            'foto' => 'image|mimes:jpeg,jpg,png,gif|file|max:1024',
        ], $messages = [
                'foto.image' => 'Format gambar harus menggunakan file dengan ekstensi jpeg, jpg, png, atau gif.',
                'foto.max' => 'Ukuran file gambar maksimal adalah 1024 KB.',
            ]);

        // Set status default
        $validatedData['status'] = 0;

        // Menggunakan ImageHelper untuk meng-upload dan resize foto
        if ($request->file('foto')) {
            $file = $request->file('foto');
            $extension = strtolower($file->getClientOriginalExtension());
            $validExtensions = ['jpeg', 'jpg', 'png', 'gif'];

            // Validasi ekstensi gambar
            if (!in_array($extension, $validExtensions)) {
                return redirect()->back()->withErrors(['foto' => 'Hanya file dengan ekstensi jpeg, jpg, png, atau gif yang diizinkan.']);
            }

            // Nama file gambar yang akan disimpan
            $originalFileName = date('YmdHis') . '_' . uniqid() . '.' . $extension;
            $directory = 'storage/img-user/';

            // Menggunakan helper untuk upload dan resize gambar
            imageHelper::uploadAndResize($file, $directory, $originalFileName, 385, 400);

            // Simpan nama file gambar di database
            $validatedData['foto'] = $originalFileName;
        }

        // Validasi password (kombinasi huruf besar, huruf kecil, angka, dan simbol)
        $password = $request->input('password');
        $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/'; // huruf kecil, huruf besar, angka, simbol

        if (preg_match($pattern, $password)) {
            // Hash password dan simpan data user
            $validatedData['password'] = Hash::make($validatedData['password']);
            User::create($validatedData);

            return redirect()->route('backend.user.index')->with('success', 'Data berhasil tersimpan');
        } else {
            return redirect()->back()->withErrors(['password' => 'Password harus terdiri dari kombinasi huruf besar, huruf kecil, angka, dan simbol karakter.']);
        }
    }

    /**
     * Fungsi lainnya
     */

 

    public function update(Request $request, string $id)
    {
        // Mendapatkan data user berdasarkan ID
        $user = User::findOrFail($id);

        // Menentukan aturan validasi
        $rules = [
            'nama' => 'required|max:255',
            'role' => 'required',
            'status' => 'required',
            'hp' => 'required|min:10|max:13',
            'foto' => 'image|mimes:jpeg,jpg,png,gif|file|max:1024',
        ];

        // Pesan kesalahan validasi
        $messages = [
            'foto.image' => 'Format gambar harus menggunakan file dengan ekstensi jpeg, jpg, png, atau gif.',
            'foto.max' => 'Ukuran file gambar maksimal adalah 1024 KB.'
        ];

        // Menambahkan aturan untuk email jika ada perubahan
        if ($request->email != $user->email) {
            $rules['email'] = 'required|max:255|email|unique:user';
        }

        // Melakukan validasi data
        $validatedData = $request->validate($rules, $messages);

        // Mengecek dan mengunggah gambar baru jika ada
        if ($request->file('foto')) {
            // Menghapus gambar lama jika ada
            if ($user->foto) {
                $oldImagePath = public_path('storage/img-user/') . $user->foto;
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            // Mengunggah gambar baru
            $file = $request->file('foto');
            $extension = $file->getClientOriginalExtension();
            $originalFileName = date('YmdHis') . '_' . uniqid() . '.' . $extension;
            $directory = 'storage/img-user/';

            // Simpan gambar dengan ukuran yang ditentukan
            ImageHelper::uploadAndResize($file, $directory, $originalFileName, 385, 400); // null untuk tinggi otomatis

            // Simpan nama file gambar di database
            $validatedData['foto'] = $originalFileName;
        }

        // Melakukan pembaruan data user
        $user->update($validatedData);

        // Redirect ke halaman daftar user dengan pesan sukses
        return redirect()->route('backend.user.index')->with('success', 'Data berhasil diperbaharui');
    }

    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        if ($user->foto) {
            $oldImagePath = public_path('storage/img-user/') . $user->foto;

            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }

        $user->delete();

        return redirect()
            ->route('backend.user.index')
            ->with('success', 'Data berhasil dihapus');

    }
    public function formUser() 
    { 
        return view('backend.v_user.form', [ 
            'judul' => 'Laporan Data User', 
        ]); 
    } 
 
    public function cetakUser(Request $request) 
    { 
        // Menambahkan aturan validasi 
        $request->validate([ 
            'tanggal_awal' => 'required|date', 
            'tanggal_akhir' => 'required|date|after_or_equal:tanggal_awal', 
        ], [ 
            'tanggal_awal.required' => 'Tanggal Awal harus diisi.', 
            'tanggal_akhir.required' => 'Tanggal Akhir harus diisi.', 
            'tanggal_akhir.after_or_equal' => 'Tanggal Akhir harus lebih besar atau sama dengan Tanggal Awal.', 
        ]); 
 
        $tanggalAwal = $request->input('tanggal_awal'); 
        $tanggalAkhir = $request->input('tanggal_akhir'); 
 
        $query =  User::whereBetween('created_at', [$tanggalAwal, $tanggalAkhir]) 
            ->orderBy('id', 'desc'); 
 
        $user = $query->get(); 
        return view('backend.v_user.cetak', [ 
            'judul' => 'Laporan User', 
            'tanggalAwal' => $tanggalAwal, 
            'tanggalAkhir' => $tanggalAkhir, 
            'cetak' => $user 
        ]); 
    } 
}
