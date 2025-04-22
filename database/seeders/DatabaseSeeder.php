<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Kategori;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'nama' => 'Administrator',
            'email' => 'admin@gmail.com',
            'role' => '1',
            'status' => 1,
            'password' => bcrypt('P@55word'), 
            'hp' => '0812345678901',
        ]);

        User::create([
            'nama' => 'Anin',
            'email' => 'anin@gmail.com',
            'role' => '0',
            'status' => 1,
            'password' => bcrypt('P@55123'), 
            'hp' => '0812345678902',
        ]);
        // User::create([
        //     'nama' => 'Mark',
        //     'email' => 'mark@gmail.com',
        //     'role' => '0',
        //     'status' => 1,
        //     'password' => bcrypt('P@55123'), 
        //     'hp' => '0812345678902',
        // ]);
        // Kategori::create([ 
        //     'nama_kategori' => 'Brownies', 
        //     ]); 
        //     Kategori::create([ 
        //     'nama_kategori' => 'Combro', 
        //     ]); 
        //     Kategori::create([ 
        //     'nama_kategori' => 'Dawet', 
        //     ]); 
        //     Kategori::create([ 
        //     'nama_kategori' => 'Mochi', 
        //     ]); 
        //     Kategori::create([ 
        //     'nama_kategori' => 'Wingko', 
        //     ]); 
    }
}
