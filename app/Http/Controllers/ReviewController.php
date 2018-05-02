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
        $review->rating = intval($request->rating);
        $review->save();
        return redirect('/restaurants/'.$id)->with('success',"Review created");
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Review  $review
     * @param  \DummyFullModelClass  $DummyModelVariable
     * @return \Illuminate\Http\Response
     */
    public function update(/*Request $request, Review $review*/)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Review  $review
     * @param  \DummyFullModelClass  $DummyModelVariable
     * @return \Illuminate\Http\Response
     */
    public function destroy(/*Review $review*/)
    {
        //
    }
}
