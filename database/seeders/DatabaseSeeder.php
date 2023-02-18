<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        \App\Models\User::factory()->create([
            '_id' => $userId,
            'username' => 'Anty43',
            'password' => '192021',
            'email' => null
        ]);

        \App\Models\Customers::factory()->create([
            'user_id'             => $userId,
            'addres_id'            => null,
            'identification_card' => '1754052718',
            'name'                => 'Anthony',
            'last_name'           => 'Santillan',
            'email'               => 'fairy.jum568@gmail.com',
            'phone'               => '0987295505',
            'role'                => 'Administrador',
            'state'               => 'activo'
        ]);

        \App\Models\Address::factory()->create([
            'city'              => 'Quito',
            'parish'                => 'Coto',
            'sector'                => 'San calos',
            'neighborhood'              => 'Ruperto alarcon',
            'main_street'               => 'n/s',
            'back_street'               => 'n/s',
            'house_number'              => 'n/s',
            'reference'                 => 'n/s'
        ]);
    }
}
