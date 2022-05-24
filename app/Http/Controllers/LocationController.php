<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Enums\Status;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $country = new Country();
        $list = $country::all();
        return view( 'location/country_index', compact( 'list' ) );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      
    }

   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $country = new Country();
        $country->name = $request->name;
        $country->currency_code = $request->currency_code;
        $country->symbol = $request->symbol;
        $country->status = Status::ENABLE;
        $country->save();
        return redirect( 'web/country/index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    // State section
    public function stateList($country_id){
        $state = new State();
        $list = $state::where('country_id','=',$country_id)->get();
        return view( 'location/state_index', compact( ['list','country_id'] ) ); 
    }

    public function stateStore(Request $request){
        $state = new State();
        $state->name = $request->name;
        $state->country_id = $request->country_id;
        $state->save();
        return redirect()->action(
            [LocationController::class, 'stateList'], ['country_id' =>  $request->country_id]
        );
    }

    // City section

    public function cityList($state_id,$country_id){
        $city = new City();
        $list = $city::where('state_id','=',$state_id)->get();
        return view( 'location/city_index', compact( ['list','state_id','country_id'] ) ); 
    }

    public function cityStore(Request $request){
        $city = new City();
        $city->name = $request->name;
        $city->state_id = $request->state_id;
        $city->save();
        return redirect()->action(
            [LocationController::class, 'cityList'], ['state_id' =>  $request->state_id,'country_id' => $request->country_id]
        );
    }
}
