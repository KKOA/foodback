<?php
declare(strict_types=1);

//Models
use App\Models\User;

use Illuminate\Database\Seeder;

/**
 * Class UserSeeder
 */
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() :void
    {
        $names = ['keith','tom','sarah','mary','aaron'];
	    $password = bcrypt('secret');
	    $domain =  'test.com';
        foreach($names as $name)
        {
	        User::firstOrCreate(
		        ['name'=>ucfirst($name)],
		        [
			        'name'          =>  ucfirst($name),
			        'email'         => $name.'@'.$domain,
			        'password'      =>  $password
		        ]
	        );
        }

    }
}
