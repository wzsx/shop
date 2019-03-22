<?php
namespace App\Http\Controllers\Seat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;

class SeatController extends Controller
{

    public function seat()
    {
        //return view('seat.seat');
        $key= 'test_bit';

        $set_status = [];
        for($i=0;$i<=30;$i++){
            $status = Redis::getBit($key,$i);
            $seat_status[$i] = $status;
        }
        $data = [
            'seat' => $seat_status
        ];
        return view('seat.seat',$data);
    }
     public function buy($pos,$status)
     {
         $key = 'test_bit';
         Redis::setbit($key,$pos,$status);
     }
}
