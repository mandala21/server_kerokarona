<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ride;

class RideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Ride::all(),200);
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
        //validate request
        $this->validate($request, [
            'from'=>'required|string',
            'to'=>'required|string',
            'day'=>'required|date_format:"d/m/Y"',
            'hour'=>'required|date_format:"H:i"',
            'spaces'=>'required|integer',
            'price'=>'required|numeric',
        ]);
        
        //create data
        $data = $request->all();
        $data['user_id'] = $request->user()->id;
        //make entitie
        $ride = Ride::create($data);
        //return intitie was created with http code 201
        return response()->json($ride,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Ride $ride)
    {
        if($ride){
            return response()->json($ride);
        } else {
            return response()->json(['error'=>'Not Found Ride',404]);
        }
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

    /**
     * Find resource with filter by from, to and day
     * 
     * @param String $from
     * @param String $to
     * @param Date $day
     * @return \Illuminate\Http\Response
     */
    public function filter(){
        //format day
        $day = isset($_GET['day']) ? date('Y-m-d', strtotime($_GET['day'])) : False;
        if($day){
            //make query
            $ride = Ride::where([['from','=',$_GET['from']],['to','=',$_GET['to']],['day','=',$day]])->get();
        } else {
            $ride = Ride::where([['from','=',$_GET['from']],['to','=',$_GET['to']]])->get();
        }
        return response()->json($ride,200);
    }
}
