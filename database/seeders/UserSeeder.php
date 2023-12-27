<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \faker\Factory::create();
        $password = Hash::make(value: '123456');

        User::create([
            'nombres' => 'admin',
            'cant_apellidos' => 2,
            'primer_apellido' => 'admin',
            'segundo_apellido' => 'admin',
            'celular' => '961340859',
            'tipo_documento_id' => 1,
            'numero_documento' => '71653958',
            'email' => 'admin@gmail.com',
            'password' => Hash::make(value: 'admin')
        ])->assignRole('Admin');

        /*for ($i=0; $i < 3; $i++) {
            User::create([
                'nombres' => $faker->name,
                'primer_apellido' => $faker->name,
                'segundo_apellido' => $faker->name,
                'celular' => $faker->phoneNumber,
                'tipo_documento_id' => 1,
                'numero_documento' => $faker->phoneNumber,
                'email' => $faker->email,
                'password' => $password
            ])->assignRole('Admin');
        }*/
    }
}
