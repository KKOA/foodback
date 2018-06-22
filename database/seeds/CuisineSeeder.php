<?php

use Illuminate\Database\Seeder;
use App\Cuisine;

class CuisineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker\Factory::create();

        $cuisine1 = Cuisine::firstOrCreate(
            ['name'=>'American'], 
            [
                'name'          =>  'American',
            ]
        );

        $cuisine2 = Cuisine::firstOrCreate(
            ['name'=>'British'], 
            [
                'name'          =>  'British',
            ]
        );

        $cuisine3 = Cuisine::firstOrCreate(
            ['name'=>'Caribbean'], 
            [
                'name'          =>  'Caribbean',
            ]
        );

        $cuisine4 = Cuisine::firstOrCreate(
            ['name'=>'Chinese'], 
            [
                'name'          =>  'Chinese',
            ]
        );

        $cuisine5 = Cuisine::firstOrCreate(
            ['name'=>'French'], 
            [
                'name'          =>  'French',
            ]
        );

        $cuisine6 = Cuisine::firstOrCreate(
            ['name'=>'Greek'], 
            [
                'name'          =>  'Greek',
            ]
        );

        $cuisine7 = Cuisine::firstOrCreate(
            ['name'=>'Indian'], 
            [
                'name'          =>  'Indian',
            ]
        );

        $cuisine8 = Cuisine::firstOrCreate(
            ['name'=>'Italian'], 
            [
                'name'          =>  'Italian',
            ]
        );

        $cuisine9 = Cuisine::firstOrCreate(
            ['name'=>'Japanese'], 
            [
                'name'          =>  'Japanese',
            ]
        );

        $cuisine10 = Cuisine::firstOrCreate(
            ['name'=>'Mediterranean'], 
            [
                'name'          =>  'Mediterranean',
            ]
        );

        //
        $cuisine11 = Cuisine::firstOrCreate(
            ['name'=>'Mexican'], 
            [
                'name'          =>  'Mexican',
            ]
        );

        $cuisine12 = Cuisine::firstOrCreate(
            ['name'=>'Moroccan'], 
            [
                'name'          =>  'Moroccan',
            ]
        );

        $cuisine13 = Cuisine::firstOrCreate(
            ['name'=>'Spanish'], 
            [
                'name'          =>  'Spanish',
            ]
        );

        $cuisine14 = Cuisine::firstOrCreate(
            ['name'=>'Thai'], 
            [
                'name'          =>  'Thai',
            ]
        );

        $cuisine15 = Cuisine::firstOrCreate(
            ['name'=>'Turkish'], 
            [
                'name'          =>  'Turkish',
            ]
        );

        $cuisine16 = Cuisine::firstOrCreate(
            ['name'=>'Vietnamese'], 
            [
                'name'          =>  'Vietnamese',
            ]
        );
    }
}
