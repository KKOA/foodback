<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Restaurant as Restaurant;
use Image;
use Storage;
use File;

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
            'cover_image' => 'sometimes|max:1999|mimes:jpeg,jpg,bmp,png'
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

        // Check has file been uploaded
        if(request()->hasFile('cover_image'))
        {

            //Check directory exist
            $path = storage_path().'/app/public/upload/restaurants/'.$restaurant->id;
            if(!File::exists($path))
            {
                //Create directory
                File::makeDirectory($path , 0777, false, true);
            }

            //Get file
            $originalImage = $request->file('cover_image');

            //Get file extension
            $ext = $originalImage->getClientOriginalName();
            
            //Open  an image file
            $img = Image::make($originalImage);

            echo $img->mime();
            //Change extension jpeg to jpg
            if($ext === 'jpeg')
            {
                $ext = 'jpg';
                $img->encode($ext);
            }


            //Generate new filename from current timestamp
            $newFileName = time().'.'.$ext;

            //resize the instance
            // $img->resize(800,454);
            $img->fit(800,454);
            
            //save file to /upload/restaurant/{restaurant->id}/
            $img->save($path.'/'.$newFileName);

            // Save filename to restaurant
            $restaurant->cover_image = $newFileName;
            $restaurant->save();

        }

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
            'cover_image' => 'sometimes|max:1999|mimes:jpeg,jpg,bmp,png'
            ]);

            $restaurant->name= $request->name;
            $restaurant->description = $request->description;
            $restaurant->address1 = $request->address1;
            $restaurant->address2 = $request->address2;
            $restaurant->city = $request->city;
            $restaurant->county = $request->county;
            $restaurant->postcode = $request->postcode;

            // Check has file been uploaded
            if(request()->hasFile('cover_image'))
            {

                //Check directory exist
                $path = storage_path().'/app/public/upload/restaurants/'.$restaurant->id;
                if(!File::exists($path))
                {
                    //Create directory
                    File::makeDirectory($path , 0777, false, true);
                }

                //Get file
                $originalImage = $request->file('cover_image');

                //Get file extension
                $ext = $originalImage->getClientOriginalName();
                
                //Open  an image file
                $img = Image::make($originalImage);

                echo $img->mime();
                //Change extension jpeg to jpg
                if($ext === 'jpeg')
                {
                    $ext = 'jpg';
                    $img->encode($ext);
                }


                //Generate new filename from current timestamp
                $newFileName = time().'.'.$ext;

                //resize the instance
                // $img->resize(800,454);
                $img->fit(800,454);
                
                //save file to /upload/restaurant/{restaurant->id}/
                $img->save($path.'/'.$newFileName);

                // Save filename to restaurant
                $restaurant->cover_image = $newFileName;
                // $restaurant->save();

            }

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
        
        //Check restaurant image directory exists
        $path = storage_path().'/app/public/upload/restaurants/'.$restaurant->id;
        if(File::exists($path))
        {
            //Delete directory
            File::deleteDirectory($path);
        }

        // return 'hope';
        $name = $restaurant->name;
        $restaurant->delete();
        return redirect()->route('restaurants.index')->with('success'," $name restaurant Deleted");
    }
}
