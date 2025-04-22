<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Produk;

class BerandaController extends Controller
{
    public function berandaBackend()
    {
        // Menghitung total pengguna dan produk
        $totalUser = User::count();
        $totalProduk = Produk::count();

        return view('backend.v_beranda.index', [
            'judul' => 'Beranda',
            'sub' => 'Halaman Beranda',
            'totalUser' => $totalUser,
            'totalProduk' => $totalProduk,
        ]);
    }

    public function index()
    {
        $produk = Produk::where('status', 1)->orderBy('updated_at', 'desc')->paginate(6);
        
        return view('v_beranda.index', [
            'judul' => 'Halaman Beranda',
            'produk' => $produk,
        ]);
    }
}