<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
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
        $user = new User();
        $user->first_name = 'Anouar';
        $user->last_name = 'Douiyeb';
        $user->email = 'douiyeb01@gmail.com';
        $user->is_admin = 1;
        $user->password = Hash::make('Welkom01');
        $user->save();
    }
}
