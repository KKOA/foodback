<?php

use Illuminate\Database\Seeder;
use App\User as User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user1 = User::firstOrCreate(
            ['name'=>'Keith'], //Greek
            [
                'name'          =>  'Keith',
                'email'         => 'keith@test.com',
                'password'      =>  bcrypt('secret')
            ]
        );

        $user2 = User::firstOrCreate(
            ['name'=>'Tom'], //Greek
            [
                'name'          =>  'Tom',
                'email'         => 'tom@test.com',
                'password'      =>  bcrypt('secret')
            ]
        );
    }
}
