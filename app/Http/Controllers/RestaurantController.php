<?php
declare(strict_types=1);

namespace App\Http\Controllers;

//Models
use App\Models\Restaurant;
use App\Models\Cuisine;

use Illuminate\Http\Request;
use \Illuminate\Http\Response;
use \Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

use Image;
use File;
use Storage;
use Auth;
use \Exception;
use App\Rules\NullOrGreaterThanMinLength as NullOrGreaterThanMinLength;


/**
 * Class RestaurantController
 * @package App\Http\Controllers
 */
class RestaurantController extends Controller
{
    
    /** 
     * Restaurant Constructor
     * @return void
    */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index','show']]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index() :View
    {
        $restaurants = Restaurant::with('reviews')->paginate(6);
        $cuisines = Cuisine::all();
        return view('restaurants.index',compact('restaurants','cuisines'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create() :View
    {
        $restaurant = new Restaurant();
        $cuisines = Cuisine::all();
        return view('restaurants.create', compact('restaurant','cuisines'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request     $request
     * @return RedirectResponse
     */
    public function store(Request $request) :RedirectResponse
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


        $restaurant = new Restaurant();
        $restaurant->user_id = Auth::user()->id;
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
//            $restaurant->cover_photo = $filename;

        }

        $restaurant->save();

        return redirect('/restaurants/'.$restaurant->id)->with('success',$restaurant->name ." restaurant created.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int      $id
     * @param Request   $request
     * @return View
     */
    public function show($id, Request $request) :View
    {
        $restaurant = Restaurant::with('reviews')->findOrFail($id);
        return view('restaurants.show',compact('restaurant'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int                          $id
     * @return View
     */
    public function edit($id) :View
    {
        $user = Auth::user();
        $restaurant = Restaurant::find($id);
        if($user->id !== $restaurant->user_id)
        {
            return redirect('/');
        }
        $cuisines = Cuisine::all();
        return view('restaurants.edit', compact('restaurant','cuisines'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request     $request
     * @param  Restaurant  $restaurant
     * @return RedirectResponse
     */
    public function update(Request $request,Restaurant $restaurant) :RedirectResponse
    {
                
        // return $restaurant->id;
        $validatedData = $request->validate([
            'name' => 'required|min:3|max:255|unique:restaurants,name,'.$restaurant->id,
            'description' => 'required|min:3',
            'address1' => 'required|min:3|max:255',
            'address2' => [new NullOrGreaterThanMinLength(3),'max:255'],         
            'city' => 'required|min:3|max:255',
            'county' => [new NullOrGreaterThanMinLength(3),'max:255'],
            'postcode' => 'required|min:3|max:10'
            ]);

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
	 * @param Restaurant $restaurant
	 * @return RedirectResponse
	 * @throws Exception
	 */
    public function destroy(Restaurant $restaurant) :RedirectResponse
    {
        $name = $restaurant->name;
        $restaurant->cuisines()->detach();
        $restaurant->delete();
        return redirect()->route('restaurants.index')->with('success'," $name restaurant deleted.");
    }
}
