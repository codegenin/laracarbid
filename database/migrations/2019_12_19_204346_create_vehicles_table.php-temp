<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('category_id');
            $table->string('vin_number');
            $table->string('location');
            $table->unsignedBigInteger('make')->index();
            $table->unsignedBigInteger('model')->index();
            $table->unsignedMediumInteger('year')->index();
            $table->unsignedInteger('mileage')->index();
            $table->string('transmission', 50);
            $table->string('drivetrain', 50);
            $table->string('color', 50);
            $table->string('trim', 50);
            $table->string('engine_type', 50);
            $table->string('fuel_type', 50);
            $table->string('action_type', 20);
            $table->float('price');
            $table->softDeletes();
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
        Schema::dropIfExists('vehicles');
    }
}
