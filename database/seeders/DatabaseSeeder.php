<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Customers;
use App\Models\Cellars;
use App\Models\Products;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $userId = Str::uuid()->toString();
        $cellarId = Str::uuid()->toString();
        User::factory()->create([
            '_id' => $userId,
            'username' => 'Anty43',
            'password' => '192021',
            'email' => null,
            'type' => 'administrador',
            'state' => 'activo'
        ]);

        Customers::factory()->create([
            'user_id'             => $userId,
            'identification_card' => '1754052718',
            'name'                => 'Anthony',
            'last_name'           => 'Santillan',
            'email'               => 'fairy.jum568@gmail.com',
            'phone'               => '0987295505',
            'role'                => 'Administrador',
            'state'               => 'activo'
        ]);

        \App\Models\Cellars::factory()->create([
            '_id'              => $cellarId,
            'code'                => 'BOD001',
            'name'              => 'Principal',
            'addres'              => 'San carlos - QUito',
        ]);

        \App\Models\Products::factory()->create([
            'code'              => 'PRO1',
            'name'                => 'Computadora',
            'price'                => 10,
            'cellar_id'              => $cellarId,
        ]);

    }
}
