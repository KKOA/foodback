<?php
declare(strict_types=1);

use Illuminate\Database\Seeder;

//Models
use App\Models\User;

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
        $names = ['Keith Fairnie','Tom Humprey','Sarah Stewart','Mary Mckenna','Aaron Amoah'];
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
