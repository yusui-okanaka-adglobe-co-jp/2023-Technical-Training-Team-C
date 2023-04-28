<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DateTime;

class GetTimetablesAcquireController extends Controller
{
    //
    public function getTimetables(Request $request)
    {
        // $dateMonday = $request->date;
        $date = "2023-12-31";
        $dateMonday = new DateTime($date);
        $getMondayYear = explode("-", ($date));
        dd($getMondayYear[0]);
        //月曜の年の祝日を取る
        $this->getHolidays($getMondayYear[0]);

        //7回繰り返すfor文
        for ($i = 1; $i < 8; $i++) {
            $getDate = $dateMonday->modify($i . ' day');
            // $getYear = explode("-", ($dateMonday + 1));
            // dd($getYear);
        }
        // if($)
        return "";
    }

    function getHolidays($date)
    {
        return "";
    }
}
