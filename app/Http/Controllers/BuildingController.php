<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Enums\MeasurementType;
use BenSampo\Enum\Rules\EnumValue;
use App\Models\Building;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\LengthMeasurement;
use App\Http\Requests\StoreBuildingRequest;
use App\Enums\BuildingType;
use App\Enums\RentOrSale;
use App\Enums\Status;
use Illuminate\Support\Facades\Storage;

class BuildingController extends Controller {
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function index() {
        return view( 'building/building_index' );
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function create() {
        // $building = new Building();
        // $building->user_account_id = 1;
        // $building->save();
        $country = new Country();
        $countryList = $country::all();

        $state = new State();
        $stateList = $state::where( 'country_id', '=', $countryList[ 0 ]->country_id )->get();

        $city = new City();
        $cityList = $city::where( 'state_id', '=', $stateList[ 0 ]->state_id )->get();

        $measurement = new LengthMeasurement();
        $measurementList = $measurement::all();

        $firstCountry = $countryList[ 0 ];

        return view( 'building/building_create', compact( [ 'countryList', 'stateList', 'cityList', 'measurementList', 'firstCountry' ] ) );
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */

    public function store( StoreBuildingRequest $request ) {
        $building = new Building();

        //room and facilities
        if ( !$request->hall ) {
            if ( $request->livingroom ) $building->livingroom = true;
            if ( $request->bedroom ) $building->bedroom = true;
            if ( $request->bathroom ) $building->bathroom = true;
            if ( $request->kitchen ) $building->kitchen = true;
            $building->hall = true;
        }
        if ( $request->parking ) $building->parking = true;
        if ( $request->water ) $building->water = true;
        if ( $request->electricity ) $building->electricity = true;
        if ( $request->aircon ) $building->aircon = true;
        if ( $request->refrigerator ) $building->refrigerator = true;
        if ( $request->funiture ) $building->funiture = true;
        

        if ( $request->buildingType == 0 ) {
            $building->buildingType =  BuildingType::HOUSE;
            if ( $request->garage ) $building->garage = true;
        } else  if ( $request->buildingType == 1 ) {
            $building->buildingType = BuildingType::APARTMENT;
            if ( $request->elevator ) $building->elevator = true;
        } else {
            $building->buildingType =  BuildingType::HOUSE;
            if ( $request->garage ) $building->garage = true;

        }

        //rent or sale
        if ( $request->rentOrSale == 0 ) {
            $building->rentOrSale = RentOrSale::RENT;
        } else if ( $request->rentOrSale == 1 ) {
            $building->rentOrSale = RentOrSale::SALE;
        } else {
            $building->rentOrSale = RentOrSale::RENT;
        }

        $building->price =  $request->price;

        // area
        $building->length_measurement_id = $request->measurement;
        $building->length = $request->length;
        $building->width = $request->width;
        $building->height = $request->height;

        //owner info
        $building->owner_name = $request->ownerName;
        $building->phone_no_1 = $request->phone1;
        $building->phone_no_2 = $request->phone2;

        //location
        $building->address = $request->address;
        $building->google_address = $request->googleAddress;
        $building->city_id = $request->city;
       // dd( $request);
        //dd(Storage::disk('s3'));
       
        Storage::disk('s3')->put('images', $request->image);
       // dd( $building );
        //return redirect()->action( '${App\Http\Controllers\BuildingController@index}' );
    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function show( $id ) {
        //
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function edit( $id ) {
        //
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function update( Request $request, $id ) {
        //
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function destroy( $id ) {

    }

    // Ajax Request

    public function stateAjax( $countryId ) {
        $state = new State();
        $stateList = $state::where( 'country_id', '=', $countryId )->get();
        return response()->json( [ 'stateList' => $stateList ] );
    }

    public function cityAjax( $stateId ) {
        $city = new City();
        $cityList = $city::where( 'state_id', '=', $stateId )->get();
        return response()->json( [ 'cityList' => $cityList ] );
    }
}
