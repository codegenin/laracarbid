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
            $table->string('make', 50);
            $table->string('model', 50);
            $table->unsignedMediumInteger('year');
            $table->unsignedInteger('mileage');
            $table->string('transmission', 50);
            $table->string('drivetrain', 50);
            $table->string('color', 50);
            $table->string('trim', 50);
            $table->string('engine_type', 50);
            $table->string('fuel_type', 50);
            $table->string('auction_type', 20);
            $table->float('price');
            $table->unsignedTinyInteger('status')->default(0); // 0 - listed, 1 auctioned, 2 sold
            $table->softDeletes();
            $table->timestamps();

            $table->index([
                'category_id',
                'mileage',
                'year'
            ]);
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
