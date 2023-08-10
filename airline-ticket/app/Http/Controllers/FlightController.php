<?php

namespace App\Http\Controllers;

use App\Models\Airline;
use App\Models\Flight;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;

class FlightController extends Controller
{
    public function show(): Response
    {
        $data = array();
        $airlines = Airline::with('extraWeightFee')->get();
        $flights = Flight::with('extraFees', 'seatTypes')->get();
        array_push($data,$airlines,$flights);
        response()->json(
            [
                'airlines' => $data
            ],
            200
        )->send();
        die;
    }
}