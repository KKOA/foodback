<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Restaurant as Restaurant;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$restaurants = Restaurant::all();
        $restaurants = Restaurant::paginate(6);
        return view('restaurants.index',compact('restaurants'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $restaurant = new Restaurant();
        return view('restaurants.create', compact('restaurant'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:restaurants|min:3|max:255',
            'description' => 'required|min:3',
            'address1' => 'required|min:3|max:255',
            'city' => 'required|min:3|max:255',
            'postcode' => 'required|min:3|max:10',
        ]);


        $restaurant = new Restaurant();
        $restaurant->name = $request->name;
        $restaurant->description = $request->description;
        $restaurant->address1 = $request->address1;
        $restaurant->address2 = $request->address2;
        $restaurant->city = $request->city;
        $restaurant->county = $request->county;
        $restaurant->postcode = $request->postcode;
        $restaurant->save();
        return redirect('/restaurants/'.$restaurant->id)->with('success',$restaurant->name ." restaurant created");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $restaurant = Restaurant::find($id);
        return view('restaurants.show',compact('restaurant'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $restaurant = Restaurant::find($id);
        return view('restaurants.edit', compact('restaurant'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //public function update(Request $request, $id)
    public function update(Request $request,Restaurant $restaurant)
    {
                
        // return $restaurant->id;
        $validatedData = $request->validate([
            'name' => 'required|min:3|max:255|unique:restaurants,name,'.$restaurant->id,
            'description' => 'required|min:3',
            'address1' => 'required|min:3|max:255',
            'city' => 'required|min:3|max:255',
            'postcode' => 'required|min:3|max:10',
            ]);
            $restaurant->name= $request->name;
            $restaurant->description = $request->description;
            $restaurant->address1 = $request->address1;
            $restaurant->address2 = $request->address2;
            $restaurant->city = $request->city;
            $restaurant->county = $request->county;
            $restaurant->postcode = $request->postcode;
            $restaurant->save();  
            return redirect()->route('restaurants.show',['restaurant' => $restaurant])->with('success',$restaurant->name." restaurant updated ");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //public function destroy($id)
    public function destroy(Restaurant $restaurant)
    {
        $name = $restaurant->name;
        $restaurant->delete();
        return redirect()->route('restaurants.index')->with('success'," $name restaurant Deleted");
    }
}
