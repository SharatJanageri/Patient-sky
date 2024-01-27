<?php

namespace App\Http\Controllers;

use App\Services\CalendarCheck;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{

     /**
     * Controller to call the function availability time.
     * 
     * @param Request $request
     * @param CalendarCheck $calendarCheck
     * 
     * 
     * @return array
     */
    public function checkAvailability(Request $request, CalendarCheck $calendarCheck):array
    {
        
            $calenderIds = ["48cadf26-975e-11e5-b9c2-c8e0eb18c1e9","452dccfc-975e-11e5-bfa5-c8e0eb18c1e9"];
            $duration = 30; 
            $period = ["2019-04-23T08:00:00Z","2019-04-28T08:40:00Z"];
            // $period = "2019-03-21T13:00:00Z/2019-03-11T15:30:00Z";  //user can send the period timestamp in a string format

        //check if the enterend date is correct 
        $checkedPeriod = $this->checkDates($period);

        //calling findAvailableTime Service to give the avalibility time. 
        $data = $calendarCheck->findAvailableTime($calenderIds,$duration, $checkedPeriod);

        return $data; 


    }

    /**
     * Function checks if the Start date is less than the End date .
     * 
     * @param $period 
     * @throws Exception
     * 
     * @return array
     */
    public function checkDates($period):array
    {
        //Array to handle the date check. 
        $dateArray = [];

        if(is_string($period)){
        
            //if string is passed, converted to the array below.
            $dateArray = explode('/',$period);
        }
        else{
            $dateArray = $period;
        }

        //check if the Start Date is greater than End Date
        if( Carbon::parse($dateArray[0]) > Carbon::parse($dateArray[1]) )
        {
            throw new Exception(" The Start Date is greater than End date");
        }
        
        
        return $dateArray;
    }
}
