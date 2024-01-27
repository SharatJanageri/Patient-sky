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
        Schema::create('timeslotstypes', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->string("name");
            $table->integer("slot_size");

            //nullable from here 
            $table->boolean("public_bookable")->default(false);
            $table->string("color")->default("#000");
            $table->string("icon")->default("icon_home");
            $table->uuid("clinic_id")->nullable();
            $table->boolean("deleted")->nullable();
            $table->boolean("out_of_office")->default(false);
            $table->boolean("enabled")->default(false);
            
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
        Schema::dropIfExists('timeslotstypes');
    }
};
