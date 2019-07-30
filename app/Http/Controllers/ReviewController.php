<?php
declare(strict_types=1);

namespace App\Http\Controllers;

//Models
use App\Models\Restaurant;
use App\Models\Review;
use App\Models\Cuisine;
use App\Models\User;

use Illuminate\Http\Request;
use \Illuminate\Http\Response;
use \Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

use Auth;
use \Exception;

// use \Illuminate\Contracts\View\Factory;

/**
 * Class ReviewController
 * @package App\Http\Controllers
 * */
class ReviewController extends Controller
{

    /** 
     * Restaurant Constructor
     * @return void
     * */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
	 * Show the form for creating a new resource.
	 * @param int $id
	 * @return View
	 * */
	public function create(int $id) 
    {
        $restaurant = Restaurant::find($id);
        if(Auth::user()->id === $restaurant->user->id)
        {
            return redirect()->route('restaurants.show',$restaurant->id)->with('error',"Cannot add review to your own restaurant");
        }

        $review = new Review();
        return view('reviews.create', compact('review','restaurant'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request     $request
     * @param   int        $id
     * @return RedirectResponse
     * */
    public function store(Request $request, int $id) :RedirectResponse
    {
        $validatedData = $request->validate([
            'comment' => 'required|min:3',
            'rating' => 'required|between:0,5',
        ]);

        $review = new Review();
        $review->user_id =  Auth::user()->id;
        $review->restaurant_id = $id;
        $review->comment = $request->comment;
        $review->rating = floatval($request->rating);
        $review->save();
        return redirect('/restaurants/'.$id)->with('success',"Review created.");
    }

    /**
	* Show the form for editing the specified resource.
	*
	* @param  int                          $restaurant_id
	* @param  int                          $review_id
	* @return View
	*/
    public function edit(int $restaurant_id, int $review_id)
    {
        $review = Review::find($review_id);
        if(Auth::user()->id !== $review->user->id)
        {
            return redirect()->route('restaurants.show',$restaurant_id);
        }
        return view('reviews.edit', compact('review'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param   Request      $request
     * @param   Restaurant    $restaurant
     * @param   int          $id
     * @return  RedirectResponse
     */
    public function update(Request $request,Restaurant $restaurant, int $id) :RedirectResponse
    {
        $validatedData = $request->validate([
            'comment' => 'required|min:3',
            'rating' => 'required|between:0,5',
        ]);

        $review = Review::find($id);
        $review->restaurant_id=$restaurant->id;
        $review->comment = $request->comment;
        $review->rating = intval($request->rating);
        $review->save();
        return redirect('/restaurants/'.$restaurant->id)->with('success',"Review updated.");
    }

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param Restaurant $restaurant
	 * @param Review $review
	 * @return RedirectResponse
	 * @throws Exception
	 */
    public function destroy(Restaurant $restaurant,Review $review) :RedirectResponse
    {
        $review->delete();
        return redirect()->route('restaurants.show',$restaurant->id)->with('success',"Review deleted.");
    }
}
