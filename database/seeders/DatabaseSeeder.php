<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Buku;
use App\Models\Kategori;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        User::create([
            'name' => 'admin',
            'email' => 'adm@c.m',
            'password' => Hash::make(12345),
            'role' => 'admin'
        ]);
        
        // Membuat Faker
        $faker = fake('id_ID');

        for ($i = 0; $i < 3; $i++) {
            Kategori::create([
                'name' => $faker->name(),
            ]);
        }

        // for($i = 0; $i < 5; $i++){
        //     Buku::create([
        //         'judul' => $faker->name(),
        //         'penulis' => $faker->name(),
        //         'penerbit' => $faker->name(),
        //         'harga' => $faker->randomNumber(4, true),
        //         'stok' => $faker->randomNumber(2, true),
        //         'kategori_id' => $faker->numberBetween(1,3)
        //     ]);
        // }

    }
}
