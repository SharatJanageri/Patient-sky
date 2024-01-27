<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Calendar;
use Illuminate\Support\Facades\DB;

class CalendarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      
        Calendar::factory()->create([
            "uuid"=> "48644c7a-975e-11e5-a090-c8e0eb18c1e9",
            "OwnerName"=> "Joanna Hef"
        ]);
        Calendar::factory()->create([
            "uuid"=> "48cadf26-975e-11e5-b9c2-c8e0eb18c1e9",
            "OwnerName"=> "Danny Boy"
        ]);
       
        Calendar::factory()->create([
            "uuid"=> "452dccfc-975e-11e5-bfa5-c8e0eb18c1e9",
            "OwnerName"=> "Emma Win"
            
        ]);

    }
}
