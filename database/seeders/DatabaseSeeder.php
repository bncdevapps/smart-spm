<?php

namespace Database\Seeders;

use App\Models\Instansi;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        User::updateOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'username' => 'admin',
                'name_instansi' => 'PT. Admin',
                'name' => 'My Admin',
                'password' => Hash::make('password123'),
                'keterangan' => 'dummy',
                'otorisasi' => 'admin',
            ]
        );
        User::updateOrCreate(
            ['email' => 'bendahara@bendahara.com'],
            [
                'username' => 'bendahara',
                'name_instansi' => 'PT. Bendahara',
                'name' => 'My Bendahara',
                'password' => Hash::make('password123'),
                'keterangan' => 'dummy',
                'otorisasi' => 'bendahara',
            ]
        );
        User::updateOrCreate(
            ['email' => 'ppk@ppk.com'],
            [
                'username' => 'ppk',
                'name_instansi' => 'PT. PPK',
                'name' => 'My PPK',
                'password' => Hash::make('password123'),
                'keterangan' => 'dummy',
                'otorisasi' => 'ppk',
            ]
        );
        User::updateOrCreate(
            ['email' => 'verifikator@verifikator.com'],
            [
                'username' => 'verifikator',
                'name_instansi' => 'PT. Verifikator',
                'name' => 'My Verifikator',
                'password' => Hash::make('password123'),
                'keterangan' => 'dummy',
                'otorisasi' => 'verifikator',
            ]
        );
        
        Instansi::firstOrCreate(
            ['nama' => 'PT. Verifikator'],
            ['keterangan' => '-']
        );
        
        Instansi::firstOrCreate(
            ['nama' => 'PT. PPK'],
            ['keterangan' => '-']
        );
        
        Instansi::firstOrCreate(
            ['nama' => 'PT. Bendahara'],
            ['keterangan' => '-']
        );
        
        Instansi::firstOrCreate(
            ['nama' => 'PT. Admin'],
            ['keterangan' => '-']
        );


    }
}
