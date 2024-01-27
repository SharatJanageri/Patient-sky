<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timeslots', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->foreignUuid('calendar_id')->constrained("calendars","id");
            $table->dateTime("start");
            $table->dateTime("end");
            //values below can be nullable 
            $table->string("type_id")->nullable();
            $table->boolean("public_bookable")->default(true);
            $table->boolean("out_of_office")->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('timeslots');
    }
};
