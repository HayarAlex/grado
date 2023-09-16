<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'rol_id' => 1,
            'name' => 'Hayar',
            'paternal'=>'Aliaga',
            'maternal'=>'Gutierrez',
            'gender'=>'1',
            'address'=>'primero de mayo',
            'email'=>'hayar@gmail.com',
            'ci' => '123465789',
            'phone'=>'78775630',
            'password'=>bcrypt(123465789)

        ]);
    }
}
