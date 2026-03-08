<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
// PENTING: Wajib import Model User & Hash agar tidak error
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Akun ADMIN UTAMA (Login pakai username: admin)
        User::create([
            'nik' => '11111',
            'name' => 'Admin Utama',
            'username' => 'admin',
            'email' => 'admin@sigap.com',
            'password' => 'password',
            'telp' => '08123456789',
            'role' => 'admin',
        ]);

        // 2. Akun WARGA CONTOH
        User::create([
            'nik' => '32010001',
            'name' => 'Warga Test',
            'username' => 'warga',
            'email' => 'warga@sigap.com',
            'password' => 'password',
            'telp' => '08987654321',
            'role' => 'masyarakat',
        ]);
    }
}
