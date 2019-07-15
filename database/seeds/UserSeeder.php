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
        $names = ['keith fairnie','tom humprey','sarah Stewart','mary mckenna','aaron amoah'];
	    $password = bcrypt('secret');
	    $domain =  'test.com';
        foreach($names as $name)
        {
	        list($firstName,$lastName) = explode(" ",$name);
        	User::firstOrCreate(
		        [
		        	'first_name'    =>  ucfirst($firstName),
			        'last_name'     =>  ucfirst($lastName)
		        ],
		        [
			        'first_name'    =>  ucfirst($firstName),
			        'last_name'     =>  ucfirst($lastName),
			        'username'      =>  $firstName.$lastName,
			        'email'         => $firstName.'@'.$domain,
			        'password'      =>  $password
		        ]
	        );
        }

    }
}
