<?php 

namespace App\Services;

use App\Models\Calendar;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class CalendarCheck{


    /**
     * Function to find the available time slot for the given Period with duration added to the Start date-time. 
     * 
     * @return array 
     */

    public function findAvailableTime(array $calendarIds, int $duration,array $periodToSearch,array $Timeslot=null ): array
    {
        $data=[];

        
        // Parse the dates using Carbon Package
        $date1 = Carbon::parse($periodToSearch[0]);
        $date2 = Carbon::parse($periodToSearch[0]);
        $diff = Carbon::parse($periodToSearch[1]);      


        $currentStartDateTime = $date1;
        $currentEndDateTime = $date2;
      
        $currentEndDateTime=$currentEndDateTime->addMinutes($duration); 
        
        // Calculate the difference between the dates
        $dayDifferences = $date1->diffInDays($diff);

        
        for($i=0; $i<=$dayDifferences; $i++){
        
            //Query to check the time availability on the timeslot associated to its calender id. 

            $check = DB::table("calendars as c")
                ->select("*")
                ->join("timeslots as t", "t.calendar_id","c.id")
                ->whereBetween("t.start",[$currentStartDateTime,$currentEndDateTime])
                ->whereBetween('t.end',[$currentStartDateTime,$currentEndDateTime])
                ->whereIn('t.calendar_id',$calendarIds)
                ->get(); 
                
       
            if($check->toArray() == null){
                $data['available_dates'][$i]["start_time"] = $currentStartDateTime->toDateString();
                $data['available_dates'][$i]["end_time"] = $currentEndDateTime->toDateString();

            }       
                     
            //for every loop add a day to check next day 
            $currentStartDateTime->addDay();
            $currentEndDateTime->addDay();


        }
       
        return $data;         


    }

}