<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\Kategori;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = Kategori::orderBy('nama_kategori', 'asc')->get();
        return view('backend.v_kategori.index', [
            'judul' => 'Kategori',
            'index' => $kategori
        ]);
    }

    public function create()
    {
        return view('backend.v_kategori.create', [
            'judul' => 'Kategori',
        ]);
    }

    public function store(Request $request)
    {
        // dd($request); 
        $validatedData = $request->validate([
            'nama_kategori' => 'required|max:255|unique:kategori',
        ]);
        Kategori::create($validatedData);
        return redirect()->route('backend.kategori.index')->with('success', 'Data berhasil tersimpan');
    }
    public function destroy(string $id)
    {
        $user = kategori::findOrFail($id);
        $user->delete();
        return redirect()->route('backend.kategori.index')->with('success', 'Data berhasil dihapus');
    }

    public function edit(string $id)
{
    // Ambil data kategori berdasarkan ID
    $kategori = Kategori::find($id);

    // Kembalikan tampilan dengan data kategori yang diedit
    return view('backend.v_kategori.edit', [
        'judul' => 'Kategori',
        'edit' => $kategori
    ]);
}

/**
 * Update the specified resource in storage.
 */
public function update(Request $request, string $id)
{
    // Aturan validasi untuk kolom nama_kategori
    $rules = [
        'nama_kategori' => 'required|max:255|unique:kategori,nama_kategori,' . $id,
    ];

    // Validasi data yang diterima
    $validatedData = $request->validate($rules);

    // Update data kategori berdasarkan ID
    Kategori::where('id', $id)->update($validatedData);

    // Redirect ke halaman kategori dengan pesan sukses
    return redirect()->route('backend.kategori.index')->with('success', 'Data berhasil diperbaharui');
}


}
