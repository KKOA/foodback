<?php
declare(strict_types=1);

use Illuminate\Database\Seeder;
use Carbon\Carbon as Carbon;
use Faker\Factory;

//Models
use App\Models\Review;
use App\Models\Restaurant;
use App\Models\User;

/**
 * Class ReviewSeeder
 */
class ReviewSeeder extends Seeder
{
    
    private $faker;

    const SECONDS_PER_DAY = Carbon::SECONDS_PER_MINUTE * Carbon::MINUTES_PER_HOUR * Carbon::HOURS_PER_DAY;


	/**
	 * Generate random create_at date based on current date
	 * @param Carbon $now
	 * @return Carbon
	 */
    public function set_create_at(Carbon $now) :Carbon
    {
        $years= $this->faker->numberBetween($min = 5, $max = 7);
        $months = $this->faker->numberBetween($min = 0, $max = Carbon::MONTHS_PER_YEAR);
        $days = $this->faker->numberBetween($min = 0, $max = 365);
        $seconds = $this->faker->numberBetween($min = 0, $max = self::SECONDS_PER_DAY);
    	$create_at = $now->subYears($years)
            ->addMonths($months)
            ->addDays($days)
            ->addSeconds($seconds)
            ;
        return $create_at;
    }

    /**
     * Generate random update_at date based on create_at date
     * @param Carbon $create_at
     * @return Carbon
     */
    public function set_update_at(Carbon $create_at) :Carbon
    {
	    $years = $this->faker->numberBetween($min = 0, $max = 3);
	    $months = $this->faker->numberBetween($min = 0, $max = Carbon::MONTHS_PER_YEAR);
	    $days = $this->faker->numberBetween($min = 0, $max = 365);
	    $seconds = $this->faker->numberBetween($min = 0, $max = self::SECONDS_PER_DAY);

    	$update_at = $create_at->addYears($years)
            ->addMonths($months)
            ->addDays($days)
            ->addSeconds($seconds)
            ;
        return $update_at;
    }
    
    /**
     * Run the database seeds.
     * @throws
     * @return void
     */
    public function run() :void
    {
        // $review = factory(Review::class,50)->create();

        $this->faker = Factory::create();

        // Get restaurants id and user id [['id'=>x,'user_id'=>y],['id'=>x,'user_id'=>y],...]
        $restaurants = Restaurant::all(['id','user_id'])->toArray();
        
        //Prevent random restaurant from having review
        shuffle($restaurants);
        // dump(array_pop($restaurants));

        $amount =count($restaurants) * $this->faker->numberBetween($min = 1, $max = 4);
        $now = Carbon::now();
        
        for($recordNo = 0; $recordNo < $amount; $recordNo++)
        {
            //Select random element of the array ['id'=>x,'user_id'=>y]
            $restaurant = $this->faker->randomElement($restaurants);

            //Array of all users that are not the owner of this restaurant
            $users = User::where('id','!=', $restaurant['user_id'])->pluck('id')->toArray();

            $create_at = $this->set_create_at(new Carbon($now));
            $update_at = $this->set_update_at(new Carbon($create_at));

            Review::Create([
                'user_id'       =>  $this->faker->randomElement($users),
                'restaurant_id' =>  $restaurant['id'],
                'comment'       =>  $this->faker->paragraph($nbSentences = $this->faker->numberBetween($min = 3, $max = 8), $variableNbSentences = true),
                'rating'        =>  $this->faker->numberBetween($min=0, $max=5),
                'created_at'    => $create_at,
                'updated_at'    => $update_at
            ]);
        }

    }
}
