<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
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
        // \App\Models\User::factory(10)->create();
        $userId = Uuid::uuid4();

        \App\Models\User::factory()->create([
            '_id' => $userId,
            'username' => 'Unibe',
            'password' => 'unibe123456'
        ]);

        \App\Models\Customers::factory()->create([
            '_id'                 => Uuid::uuid4(),
            'user_id'             => $userId,
            'identification_card' => '1754052718',
            'name'                => 'Anthony',
            'last_name'           => 'Santillan',
            'email'               => 'fairy.jum568@gmail.com',
            'phone'               => '0987295505',
            'role'                => 'Administrador',
            'state'               => 'Activo'
        ]);
    }
}
