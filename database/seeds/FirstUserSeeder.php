<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class FirstUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = "Simone Giusti";
        $user->email = "info@simonegiusti.it";
        $user->password = Hash::make("123stella");
        $user->save();
    }
}
