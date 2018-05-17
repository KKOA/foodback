<?php

namespace App\Http\Controllers;

//use App\Review;
use Illuminate\Http\Request;
use App\Restaurant as Restaurant;
use App\Review as Review;

class ReviewController extends Controller
{


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $restaurant = Restaurant::find($id);
        $review = new Review();
        return view('reviews.create', compact('review','restaurant'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    //public function store(/*Request $request, Review $review*/)
    public function store(Request $request,$id)
    {
        //dd($request,$id);
        $validatedData = $request->validate([
            'comment' => 'required|min:3',
            'rating' => 'required|between:0,5',
        ]);

        $review = new Review();
        $review->restaurant_id=$id;
        $review->comment = $request->comment;
        $review->rating = floatval($request->rating);
        $review->save();
        return redirect('/restaurants/'.$id)->with('success',"Review created");
    }

        /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($restaurant_id,$review_id)
    {

        $review = Review::find($review_id);
        return view('reviews.edit', compact('review'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Review  $review
     * @param  \DummyFullModelClass  $DummyModelVariable
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Restaurant $restaurant, $id)
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
        return redirect('/restaurants/'.$restaurant->id)->with('success',"Review updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Review  $review
     * @param  \DummyFullModelClass  $DummyModelVariable
     * @return \Illuminate\Http\Response
     */
    public function destroy(Restaurant $restaurant,Review $review)
    {
        $review->delete();
        return redirect()->route('restaurants.show',$restaurant->id)->with('success',"Review deleted");
    }
}
