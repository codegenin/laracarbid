<?php

use App\Models\Vehicle\Vehicle;
use App\Models\Vehicle\VehicleCategory;
use Illuminate\Database\Seeder;

/**
 * Class VehicleTableSeeder.
 */
class VehicleTableSeeder extends Seeder
{
    use DisableForeignKeys, TruncateTable;

    /**
     * Run the database seeds.
     */
    public function run()
    {
        $this->disableForeignKeys();

        factory(Vehicle::class, 100)->create();

        $this->enableForeignKeys();
    }
}
