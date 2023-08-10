<?php

namespace Database\Seeders;

use App\Models\Airline;
use App\Models\AirlineExtraWeightPrice;
use App\Models\ExtraFee;
use App\Models\ExtraWeightFee;
use App\Models\Flight;
use App\Models\FlightExtraFee;
use App\Models\FlightSeatPrice;
use App\Models\SeatType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $this->call(UsersTableSeeder::class);
        $this->call(AirlineTableSeeder::class);
        $this->call(ExtraFeeSeeder::class);
        $this->call(ExtraWeightSeeder::class);
        $this->call(SeatTypeSeeder::class);

        $airlines = Airline::all();
        $extraWeightFees = ExtraWeightFee::all();
        $airlines->each(function ($airline) use ($extraWeightFees) {
            $firstFlight = new Flight();
            $firstFlight->flight_number =
            substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"), 0, 6);
            $firstFlight->departure =  'New York';
            $firstFlight->destination = 'Los Angeles';
            $firstFlight->departure_time =  Carbon::parse('2023-08-09 12:00:00')->addDays($airline->id);
            $firstFlight->airline_id =  $airline->id;
            $firstFlight->save();

            $secondFlight = new Flight();
            $secondFlight->flight_number =
            substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"), 0, 6);
            $secondFlight->departure =  'London';
            $secondFlight->destination = 'Paris';
            $secondFlight->departure_time = Carbon::parse('2023-08-09 10:30:00')->addDays($airline->id);
            $secondFlight->airline_id =  $airline->id;
            $secondFlight->save();

            $thirdFlight = new Flight();
            $thirdFlight->flight_number =
            substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"), 0, 6);
            $thirdFlight->departure =  'Tokyo';
            $thirdFlight->destination = 'Sydney';
            $thirdFlight->departure_time =  Carbon::parse('2023-08-09 15:45:00')->addDays($airline->id);
            $thirdFlight->airline_id =  $airline->id;
            $thirdFlight->save();

            $fouthFlight = new Flight();
            $fouthFlight->flight_number =
            substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"), 0, 6);
            $fouthFlight->departure =  'Dubai';
            $fouthFlight->destination = 'Singapore';
            $fouthFlight->departure_time = Carbon::parse('2023-08-09 08:00:00')->addDays($airline->id);
            $fouthFlight->airline_id =  $airline->id;
            $fouthFlight->save();

            $extraWeightFees->each(
                function($extraWeightFee) use ($airline) {
                    $airlineExtraWeightFee = new AirlineExtraWeightPrice();
                    $airlineExtraWeightFee->airline_id = $airline->id;
                    $airlineExtraWeightFee->extraweightprice_id = $extraWeightFee->id;
                    $airlineExtraWeightFee->price = 10 * $airline->id * $extraWeightFee->id;
                    $airlineExtraWeightFee->save();
                }

            );
        });
        $flights = Flight::all();
        $seatTypes = SeatType::all();
        $extraFees = ExtraFee::all();
        $flights->each(
            function($flight) use ($seatTypes, $extraFees) {
                foreach($seatTypes as $seatType) {
                    $flightSeatPrice = new FlightSeatPrice();
                    $flightSeatPrice->flight_id = $flight->id;
                    $flightSeatPrice->seat_type_id = $seatType->id;
                    $price = 100 * $seatType->id * rand(1, 9);
                    $flightSeatPrice->price = $price;
                    $flightSeatPrice->save();
                }
                $randomNumber = rand(1, 4);
                for ($i = 0; $i < $randomNumber; $i ++) {
                    
                    // $flight->extraFees()->sync(array(1, 2, 3));
                    $extraFees[$i]->flights()->attach($flight->id);
                }
            }
        );

    }


}