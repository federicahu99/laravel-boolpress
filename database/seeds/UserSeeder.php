<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name= 'federica';
        $user->email= 'fedemilantb@gmail.com';
        $user->password= bcrypt('Ciao1234');
        $user->save();
    }
}
