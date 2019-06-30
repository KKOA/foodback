<?php
declare(strict_types=1);

//Models
use App\Models\Review;

use Illuminate\Database\Seeder;
use Carbon\Carbon as Carbon;

/**
 * Class ReviewSeeder
 */
class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() :void
    {
        $review = factory(Review::class,50)->create();
    }
}
