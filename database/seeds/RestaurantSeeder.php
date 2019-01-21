<?php

use Illuminate\Database\Seeder;
use App\Restaurant as Restaurant;
use App\User as User;


class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $restaurantImg = '/imgs/restaurants/';
        $faker = Faker\Factory::create();

        $lastUserId = User::all()->last()->id;

        $restaurant1 = Restaurant::firstOrCreate(
            ['name'=>'El Greco'], //Greek
            [
                // 'user_id'       =>  User::all()->random()->id,
                'user_id'       =>  User::all()->where("id","!=",$lastUserId)->random()->id,
                'name'          =>  'El Greco',
                'description'   => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
                'address1'      =>  '27 Rother Street',
                'address2'      =>  '',
                'city'          =>  'Stratford-upon-Avon',
                'county'        =>  '',
                'postcode'      =>  'CV37 6QB'
            ]
        );

        $restaurant2 = Restaurant::firstOrCreate(
            ['name'=>'Reubens'], //Russina
            [
                'user_id'       =>  User::all()->where("id","!=",$lastUserId)->random()->id,
                'name'          =>  'Reubens',
                'description'   => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
                'address1'      =>  '79 Baker Street',
                'address2'      =>  '',
                'city'          =>  'London',
                'county'        =>  '',
                'postcode'      =>  'W1U 6AG'
            ]
        );

        $restaurant3 = Restaurant::firstOrCreate(
            ['name'=>'Laduree UK'], //Swedish
            [
                'user_id'       =>  User::all()->where("id","!=",$lastUserId)->random()->id,
                'name'          =>  'Laduree UK',
                'description'   => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
                'address1'      =>  '71 Burlington Arcade',
                'address2'      =>  '',
                'city'          =>  'London',
                'county'        =>  '',
                'postcode'      =>  'W1J 0QX'
            ]
        );

        $restaurant4 = Restaurant::firstOrCreate(
            ['name'=>'Sorrentino Restaurant'], //Italien
            [
                'user_id'       =>  User::all()->where("id","!=",$lastUserId)->random()->id,
                'name'          =>  'Sorrentino Restaurant',
                'description'   => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
                'address1'      =>  '64 Gold Street',
                'address2'      =>  '',
                'city'          =>  'Northampton',
                'county'        =>  '',
                'postcode'      =>  'NN1 1RS'
            ]
        );

        $restaurant5 = Restaurant::firstOrCreate(
            ['name'=>'Makara'], //Turkish
            [
                'user_id'       =>  User::all()->where("id","!=",$lastUserId)->random()->id,
                'name'          =>  'Makara',
                'description'   => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
                'address1'      =>  '28 Church Road',
                'address2'      =>  '',
                'city'          =>  'Hove',
                'county'        =>  '',
                'postcode'      =>  'BN3 2FN'
            ]
        );

        $restaurant6 = Restaurant::firstOrCreate(
            ['name'=>'Tenkaichi'], //Japanense
            [
                'user_id'       =>  User::all()->where("id","!=",$lastUserId)->random()->id,
                'name'          =>  'Tenkaichi',
                'description'   =>  $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
                'address1'      =>  '236 City Road',
                'address2'      =>  '',
                'city'          =>  'Cardiff',
                'county'        =>  '',
                'postcode'      =>  'CF24 3JJ'
            ]
        );

        $restaurant7 = Restaurant::firstOrCreate(
            ['name'=>'Bear & Billet'],//German
            [
                'user_id'       =>  User::all()->where("id","!=",$lastUserId)->random()->id,
                'name'          =>  'Bear & Billet',
                'description'   =>  $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
                'address1'      =>  '94 Lower Bridge Street',
                'address2'      =>  '',
                'city'          =>  'Chester',
                'county'        =>  '',
                'postcode'      =>  'CH1 1RU'
            ]
        );

        $restaurant8 = Restaurant::firstOrCreate(
            ['name'=>'Akamba'], //African
            [
                'user_id'       =>  User::all()->where("id","!=",$lastUserId)->random()->id,
                'name'          =>  'Akamba',
                'description'   => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
                'address1'      =>  'Tythe Barn Lane',
                'address2'      =>  '',
                'city'          =>  'Solihull',
                'county'        =>  '',
                'postcode'      =>  'B90 1PH'
            ]
        );
        
        $restaurant9 = Restaurant::firstOrCreate(
            ['name'=>'Bistro Jacques'],//French
            [
                'user_id'       =>  User::all()->where("id","!=",$lastUserId)->random()->id,
                'name'          =>  'Bistro Jacques',
                'description'   =>  $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
                'address1'      =>  '29 Claremount Street',
                'address2'      =>  '',
                'city'          =>  'Shrewsbury',
                'county'        =>  '',
                'postcode'      =>  'SY1 1RD'
            ]
        );

        $restaurant10 = Restaurant::firstOrCreate( //American
            ['name'=>'Infamous Diner'],
            [
                'user_id'       =>  User::all()->where("id","!=",$lastUserId)->random()->id,
                'name'          =>  'Infamous Diner',
                'description'   =>  $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
                'address1'      =>  '3-5 Basil Chambers Nicholas Croft',
                'address2'      =>  '',
                'city'          =>  'Manchester',
                'county'        =>  '',
                'postcode'      =>  'M4 1EY'
            ]
        );

        $restaurant11 = Restaurant::firstOrCreate(
            ['name'=>'Los Gatos'], //Spanish
            [
                'user_id'       =>  User::all()->where("id","!=",$lastUserId)->random()->id,
                'name'          =>  'Los Gatos',
                'description'   =>  $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
                'address1'      =>  '1-3 Devizes Road',
                'address2'      =>  'Old Town',
                'city'          =>  'Swindon',
                'county'        =>  '',
                'postcode'      =>  'SN4 4BJ'
            ]
        );

        $restaurant12 = Restaurant::firstOrCreate(
            ['name'=>'Nur'], //Egyptian
            [
                'user_id'       =>  User::all()->where("id","!=",$lastUserId)->random()->id,
                'name'          =>  'Nur',
                'description'   =>  $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
                'address1'      =>  '22 Bridge Street',
                'address2'      =>  '',
                'city'          =>  'Glasgow',
                'county'        =>  '',
                'postcode'      =>  'G5 9HR'
            ]
        );

        $restaurant13 = Restaurant::firstOrCreate(
            ['name'=>'Thai Garden'], //Thai
            [
                'user_id'       =>  User::all()->where("id","!=",$lastUserId)->random()->id,
                'name'          =>  'Thai Garden',
                'description'   =>  $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
                'address1'      =>  '100 West Street',
                'address2'      =>  '',
                'city'          =>  'Bristol',
                'county'        =>  '',
                'postcode'      =>  'BS3 3LR'
            ]
        );

        $restaurant14 = Restaurant::firstOrCreate(
            ['name'=>'Amigos Mexican Restaurant'], //Mexican
            [
                'user_id'       =>  User::all()->where("id","!=",$lastUserId)->random()->id,
                'name'          =>  'Amigos Mexican Restaurant',
                'description'   => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
                'address1'      =>  '41 Friar Street',
                'address2'      =>  '',
                'city'          =>  'Worchester',
                'county'        =>  '',
                'postcode'      =>  'WR1 2NA'
            ]
        );

        $restaurant15 = Restaurant::firstOrCreate(
            ['name'=>'Lebaneat'], //Lebanese
            [
                'user_id'       =>  User::all()->where("id","!=",$lastUserId)->random()->id,
                'name'          =>  'Lebaneat',
                'description'   =>  $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
                'address1'      =>  '47 North Baliey',
                'address2'      =>  '',
                'city'          =>  'Durham',
                'county'        =>  '',
                'postcode'      =>  'DH1 3ET'
            ]
        );
    }
}
