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
        Schema::create('appointments', function (Blueprint $table) {
            $table->uuid("id")->primary();
           
            $table->datetime("start");
            $table->datetime("end");

            //nullable after all this . 
            $table->string("patient_id")->nullable();
            $table->string("patient_comment")->nullable();
            $table->mediumText("note")->nullable();
           
            $table->string("type_id")->nullable();
            $table->integer("state",false)->nullable();
            $table->mediumText("out_of_office_location")->default("");
            $table->boolean("out_of_office")->default(false);
            $table->boolean("completed")->default(false);
            $table->boolean("is_scheduled")->default(false);

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
        Schema::dropIfExists('appointments');
    }
};
