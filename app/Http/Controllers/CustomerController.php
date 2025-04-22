<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Hash;
use App\Helpers\ImageHelper;

class CustomerController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        // \Illuminate\Support\Facades\Log::info('Masuk callback Google');
        try {
            $socialUser = Socialite::driver('google')->user();
            $registeredUser = User::where('email', $socialUser->email)->first();

            if (!$registeredUser) {
                $user = User::create([
                    'nama' => $socialUser->name,
                    'email' => $socialUser->email,
                    'role' => '2',
                    'status' => 1,
                    'password' => Hash::make('default_password'),
                    'hp' => '',
                ]);

                Customer::create([
                    'user_id' => $user->id,
                    'google_id' => $socialUser->id,
                    'google_token' => $socialUser->token,
                ]);
                // if ($user) {
                //     Customer::create([
                //         'user_id' => $user->id,
                //         'google_id' => $socialUser->id,
                //         'google_token' => $socialUser->token,
                //     ]);
                // }

                Auth::login($user);
            } else {
                Auth::login($registeredUser);
            }

            return redirect()->intended('beranda');
        } catch (\Exception $e) {
            return redirect('/')->with('error', 'Terjadi kesalahan saat login dengan Google.');
        }
    }

    public function index()
    {
        $customer = Customer::orderBy('id', 'desc')->get();
        return view('backend.v_customer.index', [
            'judul' => 'Customer',
            'sub' => 'Halaman Customer',
            'index' => $customer
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Anda telah berhasil logout.');
    }

    public function akun($id)
    {
        $loggedInCustomerId = Auth::user()->id;

        if ($id != $loggedInCustomerId) {
            return redirect()->route('customer.akun', ['id' => $loggedInCustomerId])
                ->with('msgError', 'Anda tidak berhak mengakses akun ini.');
        }

        $customer = Customer::where('user_id', $id)->firstOrFail();

        return view('v_customer.edit', [
            'judul' => 'Customer',
            'subJudul' => 'Akun Customer',
            'edit' => $customer,
        ]);
    }

    public function updateAkun(Request $request, $id)
    {
        $customer = Customer::where('user_id', $id)->firstOrFail();
        $user = $customer->user;

        $rules = [
            'nama' => 'required|max:255',
            'hp' => 'required|min:10|max:13',
            'foto' => 'image|mimes:jpeg,jpg,png,gif|file|max:1024',
        ];

        if ($request->email != $user->email) {
            $rules['email'] = 'required|email|unique:user,email';
        }

        $validatedData = $request->validate($rules);

        if ($request->file('foto')) {
            if ($user->foto) {
                $oldImagePath = public_path('storage/img-customer/') . $user->foto;
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $file = $request->file('foto');
            $extension = $file->getClientOriginalExtension();
            $originalFileName = date('YmdHis') . '_' . uniqid() . '.' . $extension;
            $directory = 'storage/img-customer/';

            ImageHelper::uploadAndResize($file, $directory, $originalFileName, 385, 400);
            $validatedData['foto'] = $originalFileName;
        }

        $user->update($validatedData);

        $customer->update([
            'alamat' => $request->input('alamat'),
            'pos' => $request->input('pos'),
            'hp' => $request->input('hp'),
        ]);

        return redirect()->route('customer.akun', $id)->with('success', 'Data berhasil diperbarui');
    }
}
