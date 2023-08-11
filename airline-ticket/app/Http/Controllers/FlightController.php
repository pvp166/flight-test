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
        array_push($data, $airlines, $flights);
        response()->json(
            [
                'airlines' => $data
            ],
            200
        )->send();
        die;
    }
    public function find(Request $request): Response
    {

        $this->validate($request, [
            'departure' => 'required|string',
            'destination' => 'required|string',
            'seatType' => 'string',
        ]);
        // $token = $request->bearerToken();
        // if (!$token) {
        //     $requestInput = $request->input();
        //     if (isset($requestInput['token'])) $token = $requestInput['token'];
        // }
        // var_dump($token);
        if ($request->seatType == 'Any') {
            if ($request->departureTime) {
                $flights = Flight::with('seatTypes', "airline", "extraFees")
                    ->where('departure', 'LIKE', "%{$request->departure}%")
                    ->where('destination', 'LIKE', "%{$request->destination}%")
                    ->whereDate('departure_time', '>=', $request->departureTime)
                    ->get();
            } else {
                $flights = Flight::with('seatTypes', "airline", "extraFees")
                    ->where('departure', 'LIKE', "%{$request->departure}%")
                    ->where('destination', 'LIKE', "%{$request->destination}%")
                    ->get();
            }
        } else {
            if ($request->departureTime) {
                $flights = Flight::with([
                    'seatTypes' => function ($query) use ($request) {
                        $query->where('name', 'LIKE', "$request->seatType");
                    },
                    'airline',
                    "extraFees"
                ])
                    ->where('departure', 'LIKE', "%{$request->departure}%")
                    ->where('destination', 'LIKE', "%{$request->destination}%")
                    ->whereDate('departure_time', '>=', $request->departureTime)
                    ->get();
            } else {
                $flights = Flight::with([
                    'seatTypes' => function ($query) use ($request) {
                        $query->where('name', 'LIKE', "$request->seatType");
                    },
                    'airline',
                    "extraFees"
                ])
                    ->where('departure', 'LIKE', "%{$request->departure}%")
                    ->where('destination', 'LIKE', "%{$request->destination}%")
                    ->get();
            }
        }

        response()->json(
            [
                'airlines' => $flights
            ],
            200
        )->send();
        die;
    }
    public function detail(Request $request): Response
    {
        $detail = Flight::with([
            'seatTypes' => function ($query) use ($request) {
                $query->where('name', 'LIKE', "$request->seatType");
            },
            'airline',
            "extraFees",
            "airline.extraWeightFee"
        ])
            ->where('id', '=', $request->id)
            ->get();
        response()->json(
            [
                'info' => $detail
            ],
            200
        )->send();
        die;
    }
}