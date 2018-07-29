<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Restaurant as Restaurant;
use App\Cuisine as Cuisine;
use Image;
use File;
use Storage;

use App\Rules\NullOrGreaterThanMinLength as NullOrGreaterThanMinLength;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $restaurants = Restaurant::with('reviews')->paginate(6);
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
        $cuisines = Cuisine::all();
        return view('restaurants.create', compact('restaurant','cuisines'));
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
            'address2' => [new NullOrGreaterThanMinLength(3),'max:255'],         
            'city' => 'required|min:3|max:255',
            'county' => [new NullOrGreaterThanMinLength(3),'max:255'],
            'postcode' => 'required|min:3|max:10'
        ]);

        //dd($request);

        //dd($request->cuisines);

        $restaurant = new Restaurant();
        $restaurant->name = $request->name;
        $restaurant->description = $request->description;
        $restaurant->address1 = $request->address1;
        $restaurant->address2 = $request->address2;
        $restaurant->city = $request->city;
        $restaurant->county = $request->county;
        $restaurant->postcode = $request->postcode;
        $restaurant->save();

        //Cuisine
        $cuisines = $request->cuisines === null ? [] : $request->cuisines; 
        $restaurant->cuisines()->attach($cuisines);
        // Store in the database
        if($request->hasFile('cover_photo'))// same name 
        {
            //Check directory exists
                //Create directory
                
            

            // Add filename to 
            $restaurant->cover_photo = $filename;

        }

        $restaurant->save();


        return redirect('/restaurants/'.$restaurant->id)->with('success',$restaurant->name ." restaurant created.");
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
        $restaurant = Restaurant::with('reviews')->find($id);
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
        $cuisines = Cuisine::all();
        return view('restaurants.edit', compact('restaurant','cuisines'));
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
            'name' => 'required|unique:restaurants|min:3|max:255',
            'description' => 'required|min:3',
            'address1' => 'required|min:3|max:255',
            'address2' => [new NullOrGreaterThanMinLength(3),'max:255'],         
            'city' => 'required|min:3|max:255',
            'county' => [new NullOrGreaterThanMinLength(3),'max:255'],
            'postcode' => 'required|min:3|max:10'
            ]);

            // dd($request);

            $restaurant->name= $request->name;
            $restaurant->description = $request->description;
            $restaurant->address1 = $request->address1;
            $restaurant->address2 = $request->address2;
            $restaurant->city = $request->city;
            $restaurant->county = $request->county;
            $restaurant->postcode = $request->postcode;
            $restaurant->save();
            
            $cuisines = $request->cuisines === null ? [] : $request->cuisines;  
            $restaurant->cuisines()->sync($cuisines); 
            return redirect()->route('restaurants.show',['restaurant' => $restaurant])->with('success',$restaurant->name." restaurant updated.");
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
        $restaurant->cuisines()->detach();
        $restaurant->delete();
        return redirect()->route('restaurants.index')->with('success'," $name restaurant deleted.");
    }
}
